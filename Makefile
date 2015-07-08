.PHONY: all tests clean

all: vendor

vendor:
	composer install

tests: all
	./vendor/bin/phpunit

clean:
	rm -rf vendor
	rm composer.lock
