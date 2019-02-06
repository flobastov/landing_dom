cache-clear:
    @test -f bin/console && bin/console cache:clear --no-warmup || rm -rf var/cache/*
.PHONY: cache-clear

cache-warmup: cache-clear
    @test -f bin/console && bin/console cache:warmup || echo "cannot warmup the cache (needs symfony/console)"
.PHONY: cache-warmup

prod-prepare: cache-clear cache-warmup

server:
	@test -f bin/console && bin/console server:run

build:
	composer install --prefer-dist -o --no-dev
	bin/console ckeditor:install
	bin/console assets:install

migrate:
	bin/console doctrine:migrations:migrate -q

format:
	php-cs-fixer fix --allow-risky=yes --config ./.php_cs ./src
	php-cs-fixer fix --allow-risky=yes --config ./.php_cs ./tests
.PHONY: format

test:
	vendor/bin/phpunit
.PHONY: test

test-coverage:
	@test -f /usr/local/opt/php71-xdebug/xdebug.so && php -dzend_extension=/usr/local/opt/php71-xdebug/xdebug.so ./vendor/bin/phpunit --coverage-html=./coverage || php -dzend_extension=/usr/local/opt/php72-xdebug/xdebug.so ./vendor/bin/phpunit --coverage-html=./coverage
.PHONY: test-coverage

test-ci:
	composer --version
	composer install --prefer-dist
	vendor/bin/phpunit
.PHONY: test-ci
