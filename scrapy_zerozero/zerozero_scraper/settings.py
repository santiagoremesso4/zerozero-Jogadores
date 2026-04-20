BOT_NAME = "zerozero_scraper"

SPIDER_MODULES = ["zerozero_scraper.spiders"]
NEWSPIDER_MODULE = "zerozero_scraper.spiders"

ROBOTSTXT_OBEY = False
DOWNLOAD_DELAY = 1
USER_AGENT = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36"

REQUEST_FINGERPRINTER_IMPLEMENTATION = "2.7"
FEED_EXPORT_ENCODING = "utf-8"
