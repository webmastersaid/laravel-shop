up: 
	docker-compose up -d
start: 
	docker-compose start
stop: 
	docker-compose stop
restart:
	docker-compose restart
down: 
	docker-compose down
sh: 
	docker exec -it laravel-shop-laravel.test-1 sh
bash: 
	docker exec -it laravel-shop-laravel.test-1 bash