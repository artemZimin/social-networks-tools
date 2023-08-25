build:
	composer install --ignore-platform-reqs
	./vendor/bin/sail up -d
	./vendor/bin/sail artisan queue:work
