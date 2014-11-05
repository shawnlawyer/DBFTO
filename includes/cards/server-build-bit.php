<div class="headline">Ubuntu Bash Build Script Example</div>
<br>
<div class="card">
    <div class="subline">Headless Ubuntu Machine Bash Build Script Example</div>
    <pre class="code">
sudo apt-get update
sudo apt-get upgrade -y
(echo n; echo p; echo 1; echo ; echo ; echo w) | sudo fdisk /dev/[%machine-ebs-mount%]
sudo mkfs.ext4 /dev/[%machine-ebs-mount%]
sudo mkdir /opts
sudo mount /dev/[%machine-ebs-mount%] /opts
echo "/dev/[%machine-ebs-mount%] /opts auto noatime 0 0" | sudo tee -a /etc/fstab
sudo ln -sf /usr/share/zoneinfo/[%machine-timezone%] /etc/localtime
sudo chown ubuntu:ubuntu /opts
sudo apt-get -y install git
cd /opts
mkdir checkout
wget https://[%aws-bucket%].[%aws-bucket-location%].amazonaws.com/[%aws-bucket-git-keys%]/id_rsa
wget https://[%aws-bucket%].[%aws-bucket-location%].com/[%aws-bucket-git-keys%]id_rsa.pub
wget https://[%aws-bucket%].[%aws-bucket-location%].com/[%aws-bucket-git-keys%]/known_hosts
mv id_rsa ~/.ssh/id_rsa
mv id_rsa.pub ~/.ssh/id_rsa.pub
mv known_hosts ~/.ssh/known_hosts
chmod 600 ~/.ssh/id_rsa
    </pre>
</div>