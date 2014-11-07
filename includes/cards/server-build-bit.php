<div class="headline">Ubuntu Bash Build Script Example</div>
<br>
<div class="card">
    <div class="subline">Headless Ubuntu Machine Bash Build Script Example</div>
    <pre class="code">
sudo apt-get -y install nginx
sudo service nginx start
sudo apt-get -y install php5-fpm
sudo apt-get -y install php5-mysql
cd /opts/checkout
sudo rm -Rf *
[%aws-bucket%].[%aws-bucket-location%].amazonaws.com/[%aws-bucket-git-keys%]
sudo wget https://[%aws-bucket%].[%aws-bucket-location%].amazonaws.com/[%aws-bucket-configs%]/php5-fpm/php.ini
sudo mv php.ini /etc/php5/fpm/php.ini
wget https://%aws-bucket%].[%aws-bucket-location%]/[%aws-bucket-configs%]/php5-fpm/pool.d/www.conf
sudo mv www.conf /etc/php5/fpm/pool.d/www.conf
wget https://%aws-bucket%].[%aws-bucket-location%]/[%aws-bucket-configs%]/nginx/default
sudo mv default /etc/nginx/sites-available/default
sudo service php5-fpm restart
sudo service nginx stop
sudo service nginx start
cd /opts/checkout
sudo rm -Rf *
    </pre>
</div>