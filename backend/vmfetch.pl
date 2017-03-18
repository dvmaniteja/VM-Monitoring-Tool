#!usr/bin/perl 
use Net::OpenSSH;
use IPC::System::Simple qw(capture);
use DBI;
use DBD::mysql;
use Data::Dumper;
use RRD::Simple;

require 'db1.conf';

$dsn = "DBI:mysql:$database";
$dbh = DBI->connect($dsn,$user,$pwd);

  $sth = $dbh->prepare("SELECT * FROM DEVICES");
  $sth->execute;

while($ary_ref = $sth->fetchrow_arrayref())
{
 $ipaddres=$$ary_ref[1];
 $username=$$ary_ref[2];
 $password=$$ary_ref[3];

my $ssh = Net::OpenSSH->new(host => "$ipaddres", user => "root", password => "$password");
  $ssh->error and
    die "Couldn't establish SSH connection to $ipaddres: ". $ssh->error;

my @line = $ssh->capture("virsh list | awk '{print \$2}'"); 
print "$line[0]";
print "$line[1]";
print "$line[2]";
print "$line[3]";


$ssh->capture("exit");

foreach $newline (@line)
 {
 	 $dbh1= "INSERT INTO DEVICES (IP,Username,Password,VMname) VALUES ('$ipaddres','$username','$password','$newline')";
	 $dbh->do($dbh1);
         $dbh2= "DELETE FROM DEVICES WHERE VMName='$line[1]'";
         $dbh->do($dbh2); 
         $dbh3= "DELETE FROM DEVICES WHERE VMName='$line[0]'";
         $dbh->do($dbh3);
}
}

 

