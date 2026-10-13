server {
        server_name www.republikbobotoh.com republikbobotoh.com;

	error_log /home/rb/neurepublikbobotoh/logs/error.log error;

        # Load configuration files for the default server block.
        #include /etc/nginx/default.d/*.conf;

	add_header 'Access-Control-Allow-Origin' '*';
  	add_header 'Access-Control-Allow-Methods' 'GET, POST, OPTIONS';
  	add_header 'Access-Control-Allow-Headers' 'DNT,User-Agent,X-Requested-With,If-Modified-Since,Cache-Control,Content-Type,Range';

	#map $http_upgrade $connection_upgrade {
	#	default upgrade;
	#	''	close;
	#}


        location / {
		proxy_set_header Accept-Encoding "";
		proxy_set_header Origin "";
		proxy_set_header Host $host;
		proxy_redirect off;
		proxy_http_version 1.1;
		proxy_set_header Origin https://$host;
		proxy_set_header Upgrade $http_upgrade;
            	proxy_set_header Connection $connection_upgrade;
    		proxy_set_header X-Forwarded-Proto $scheme;
		proxy_set_header X-Forwarded-Port $server_port;
		proxy_set_header X-Forwarded-Host $host:$server_port;
    		proxy_set_header X-Real-IP $remote_addr;
    		proxy_set_header X-Forwarded-For $remote_addr;
        	proxy_pass   http://republikbobotoh.com:1933;
	}
	
	location /assets/ {
                add_header Cache-Control "public, no-transform";
                add_header Vary "Accept-Encoding";
                expires max;
                alias /home/rb/neurepublikbobotoh/public/assets/;
        }

 	location /wp-content/ {
        	add_header Cache-Control "public, no-transform";
        	add_header Vary "Accept-Encoding";
        	expires max;
        	alias /home/rb/neurepublikbobotoh/public/assets/;
 	}




    listen 443 ssl; # managed by Certbot
    ssl_certificate /etc/letsencrypt/live/republikbobotoh.com/fullchain.pem; # managed by Certbot
    ssl_certificate_key /etc/letsencrypt/live/republikbobotoh.com/privkey.pem; # managed by Certbot
    include /etc/letsencrypt/options-ssl-nginx.conf; # managed by Certbot
    ssl_dhparam /etc/letsencrypt/ssl-dhparams.pem; # managed by Certbot


}

server {
    if ($host = www.republikbobotoh.com) {
        return 301 https://$host$request_uri;
    } # managed by Certbot


    if ($host = republikbobotoh.com) {
        return 301 https://$host$request_uri;
    } # managed by Certbot


        server_name www.republikbobotoh.com republikbobotoh.com;
    listen 80;
    return 404; # managed by Certbot




}