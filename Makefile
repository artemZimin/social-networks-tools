build:
	composer install --ignore-platform-reqs
	./vendor/bin/sail up
