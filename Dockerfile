FROM cilogon/debian-openidc:v0.2
EXPOSE 80 443
COPY index.php /var/www/html/oidc/index.php
