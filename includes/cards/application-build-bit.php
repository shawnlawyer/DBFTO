
<div class="card">
    <div class="headline">Ubuntu Bash Build Script Example</div>
    <br>
    <div class="subline">Headless Ubuntu Machine Bash Build Script Example</div>
    <pre class="code">
cd /opts
sudo rm -Rf *
mkdir checkout
mkdir includes
mkdir classes
mkdir nginx 
cd /opts/nginx/
mkdir html
cd /opts/checkout
git clone git@github.com:/[%github-repository-owner%]/[%github-repository-name%].git
cd [%github-repository-name%]/
#git checkout master
#git checkout development
cp -r classes/* /opts/classes/
cp -r classes/.[^.]* /opts/classes/
cp -r includes/* /opts/includes/
cp -r includes/.[^.]* /opts/includes/
cp -r www/* /opts/nginx/html
cp -r www/.[^.]* /opts/nginx/html


cd /opts/checkout
sudo rm -Rf *
cd /opts/nginx/html
export DEPLOYED="\n\n\n******************************************\n**************[%application-name%] Deployed************\n******************************************\n\n\n"
clear
echo -e ${DEPLOYED}
# tail -50 /var/log/nginx/error.log
    </pre>
</div>