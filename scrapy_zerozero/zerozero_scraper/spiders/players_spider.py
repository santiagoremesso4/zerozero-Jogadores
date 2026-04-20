import re
from urllib.parse import urljoin

import scrapy
from parsel import Selector

from zerozero_scraper.items import ZerozeroPlayerItem


class PlayersSpider(scrapy.Spider):
    name = "players"
    allowed_domains = ["zerozero.pt"]
    start_urls = [
        "https://www.zerozero.pt/jogador/lionel-messi",
        "https://www.zerozero.pt/jogador/cristiano-ronaldo",
        "https://www.zerozero.pt/jogador/gianluca-prestianni/977459?search=1",
    ]

    def parse(self, response):
        rows = self.extract_personal_rows(response)
        birth_date, age = self.parse_birth_data(rows.get("Data de Nascimento", ""))
        birth_place = rows.get("País de Nascimento (Naturalidade)", "")
        country, naturality = self.parse_birth_place(birth_place)
        height, weight = self.parse_height_weight(rows.get("Altura / Peso", ""))

        item = ZerozeroPlayerItem()
        item["slug"] = self.extract_slug(response.url)
        item["nome"] = rows.get("Nome", "")
        item["data_nascimento"] = birth_date
        item["idade"] = age
        item["pais_nascimento"] = country
        item["naturalidade"] = naturality
        item["nacionalidade"] = self.extract_nationality(rows)
        item["dupla_nacionalidade"] = self.extract_double_nationality(rows)
        item["ligacoes"] = rows.get("Ligações", "")
        item["parentescos"] = rows.get("Parentescos", "")
        item["situacao"] = rows.get("Situação", "")
        item["internacionalizacoes_a"] = rows.get("Internacionalizações A", "")
        item["altura"] = height
        item["peso"] = weight
        item["posicoes"] = self.normalize_positions(rows.get("Posição", ""))
        item["clube_atual"] = rows.get("Clube atual", "")
        item["valor_mercado"] = self.extract_market_value(response)
        item["resumo"] = self.extract_table_after_heading(response, "Resumo")
        item["historico"] = self.extract_table_after_heading(response, "Histórico")
        item["transferencias_entradas"] = self.extract_transfers(response)
        item["transferencias_saidas"] = []
        item["factos"] = self.extract_faq(response)
        item["top"] = self.extract_table_after_heading(response, "Tops")
        item["fotografias"] = self.extract_photographs(response)
        item["sala_trofeus"] = self.extract_table_after_heading(response, "Títulos")
        item["partilhou_plantel_com"] = self.extract_simple_links(response, "Partilhou plantel com")
        item["fotos_perfil"] = self.extract_profile_photos(response)
        item["raio_x_url"] = self.extract_raio_x_url(response)
        item["profile_url"] = response.url

        yield item

    def extract_personal_rows(self, response):
        rows = {}
        for raw_row in response.css(".card-data__row").getall():
            row_selector = Selector(text=raw_row)
            label_parts = row_selector.css(".card-data__label *::text, .card-data__label::text").getall()
            value_parts = row_selector.css(
                ".card-data__value *::text, .card-data__value::text, .card-data__values *::text, "
                ".fl-r-cen *::text, img::attr(alt)"
            ).getall()

            label = self.clean_text(" ".join(label_parts))
            value = self.clean_text(" ".join(value_parts))

            if label and value:
                if label == "Posição":
                    value = value.replace("Futebol ", "").strip()
                rows[label] = value

        return rows

    def parse_birth_data(self, value):
        match = re.search(r"(\d{4}-\d{2}-\d{2})\s+\((\d+)\s+anos\)", value)
        if not match:
            return value, ""

        return match.group(1), match.group(2)

    def parse_birth_place(self, value):
        match = re.match(r"(.+?)\s+\((.+)\)$", value)
        if not match:
            return value, ""

        return match.group(1).strip(), match.group(2).strip()

    def parse_height_weight(self, value):
        match = re.match(r"(.+?)\s*/\s*(.+)", value)
        if not match:
            return value, ""

        return match.group(1).strip(), match.group(2).strip()

    def extract_nationality(self, rows):
        nationality = rows.get("Nacionalidade", "")
        if nationality:
            return nationality

        full = rows.get("Nacionalidade / Dupla Nacionalidade", "")
        return full.split(" ", 1)[0] if full else ""

    def extract_double_nationality(self, rows):
        full = rows.get("Nacionalidade / Dupla Nacionalidade", "")
        single = rows.get("Nacionalidade", "")

        if not full or single:
            return ""

        parts = full.split()
        return " ".join(parts[1:]) if len(parts) > 1 else ""

    def extract_market_value(self, response):
        text = self.clean_text(" ".join(response.css("body *::text").getall()))
        match = re.search(r"Valor de Mercado\s+([0-9.,]+\s*M\s*€|[0-9.,]+\s*€)", text)
        return match.group(1) if match else ""

    def extract_slug(self, url):
        parts = [part for part in url.split("?")[0].rstrip("/").split("/") if part]
        if not parts:
            return ""

        last = parts[-1]
        if last.isdigit() and len(parts) >= 2:
            return parts[-2]

        return last

    def normalize_positions(self, value):
        parts = value.split()
        joined = " ".join(parts)
        duplicate_half = joined[: len(joined) // 2].strip()
        if duplicate_half and joined == f"{duplicate_half} {duplicate_half}":
            return duplicate_half

        midpoint = len(parts) // 2
        if midpoint and parts[:midpoint] == parts[midpoint:]:
            return " ".join(parts[:midpoint])

        return joined

    def extract_table_after_heading(self, response, heading_startswith):
        heading = response.xpath(f"//h2[starts-with(normalize-space(), '{heading_startswith}')][1]")
        if not heading:
            return []

        table = heading.xpath("following::table[1]")
        if not table:
            return []

        return self.extract_table_from_selector(table)

    def extract_transfers(self, response):
        heading = response.xpath("//h2[normalize-space()='Transferências'][1]")
        if not heading:
            return []

        table = heading.xpath("following::table[1]")
        if not table:
            return []

        rows = self.extract_table_from_selector(table)
        return [row for row in rows if row.get("Equipa") != "Inter Miami CF" or row.get("Época") != "2023"]

    def extract_table_from_selector(self, table):
        headers = [self.clean_text(x) for x in table.xpath(".//tr[1]//th//text()").getall()]
        rows = []

        for tr in table.xpath(".//tr[position()>1]"):
            values = [self.clean_text(x) for x in tr.xpath("./th//text() | ./td//text()").getall()]
            values = [value for value in values if value]
            if not values:
                continue

            row = {}
            for index, value in enumerate(values):
                key = headers[index] if index < len(headers) and headers[index] else f"coluna_{index + 1}"
                row[key] = value
            rows.append(row)

        return rows

    def extract_faq(self, response):
        heading = response.xpath("//h2[starts-with(normalize-space(), 'Perguntas Frequentes')][1]")
        if not heading:
            return []

        items = []
        faq_cards = heading.xpath("following::div[contains(@class, 'faq-block')][1]//div[contains(@class, 'faq-card')]")
        for card in faq_cards:
            question = self.clean_text(" ".join(card.xpath(".//*[@itemprop='name']//text()").getall()))
            answer = self.clean_text(" ".join(card.xpath(".//*[@itemprop='text']//text()").getall()))
            if question or answer:
                items.append({"Pergunta": question or "-", "Resposta": answer or "-"})

        return items

    def extract_photographs(self, response):
        container = response.xpath("//div[contains(@class, 'photo-grid-container')][1]")
        if not container:
            return []

        rows = []
        for card in container.xpath(".//div[contains(@class, 'zz-img-grid')]"):
            href = card.xpath(".//a/@href").get()
            image = card.xpath(".//img/@src").get()
            if href or image:
                rows.append({
                    "Título": "Fotografia",
                    "Ver": urljoin(response.url, href) if href else "",
                    "Imagem": urljoin(response.url, image) if image else "",
                })

        footer = response.xpath("//a[contains(@href, 'player_photos.php')][1]/@href").get()
        if footer:
            rows.append({
                "Título": "Mais fotografias",
                "Ver": urljoin(response.url, footer),
                "Imagem": "",
            })

        return rows[:30]

    def extract_profile_photos(self, response):
        heading = response.xpath("//h2[normalize-space()='Fotos de Perfil'][1]")
        if not heading:
            return []

        rows = []
        cards = heading.xpath("following::div[contains(@class, 'zz-tpl-row')][1]//div[contains(@class, 'zz-tpl-col')]")
        for card in cards:
            href = card.xpath(".//a[@href][1]/@href").get()
            image = self.extract_background_image(
                card.xpath(".//div[contains(@class, 'player_photo')]/@style").get()
            )
            texts = [
                self.clean_text(text)
                for text in card.xpath(".//a//text()").getall()
                if self.clean_text(text) and self.clean_text(text) != "D"
            ]
            title = " ".join(texts[:6]).strip()

            if href or image or title:
                rows.append({
                    "Título": title or "Foto de perfil",
                    "Ver": urljoin(response.url, href) if href else "",
                    "Imagem": urljoin(response.url, image) if image else "",
                })

        return rows[:20]

    def extract_background_image(self, style_value):
        if not style_value:
            return ""

        match = re.search(r"background-image\s*:\s*url\((['\"]?)(.+?)\1\)", style_value)
        if not match:
            return ""

        return match.group(2).strip()

    def extract_simple_links(self, response, heading_name):
        heading = response.xpath(f"//h2[normalize-space()='{heading_name}'][1]")
        if not heading:
            return []

        links = heading.xpath("following::div[1]//a")
        results = []
        for link in links[:20]:
            name = self.clean_text(" ".join(link.xpath(".//text()").getall()))
            href = link.attrib.get("href", "").strip()
            if name and href:
                results.append({"nome": name, "url": urljoin(response.url, href)})
        return results

    def extract_raio_x_url(self, response):
        href = response.css("a[href*='/raiox']::attr(href)").get()
        return urljoin(response.url, href) if href else ""

    def clean_text(self, value):
        return re.sub(r"\s+", " ", value or "").strip()
