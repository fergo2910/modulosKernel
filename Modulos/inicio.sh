sudo rm /var/www/html/proc.txt
sudo rmmod modulomem
sudo rmmod modulocpu
sudo rmmod moduloprocesos

cd /var/www/html/Modulos/memoria
make
sudo insmod modulomem.ko

cd /var/www/html/Modulos/procesos
make
sudo insmod moduloprocesos.ko

cd /var/www/html/Modulos/cpu
make
sudo insmod modulocpu.ko

cat /proc/infomem
cat /proc/infocpu
head /proc/infoproc

echo 'localhost/memoria.php'