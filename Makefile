server_start:
	php -S 127.0.0.1:8000 -t ./public
fix:
	tools/php-cs-fixer/vendor/bin/php-cs-fixer fix src

.PHONY: server_start
