<?php

$path=$_SERVER['DOCUMENT_ROOT'];
require_once $path."/attendanceapp/database/database.php";
function clearTable($dbo,$tabName)
{
    $c="delete from :tabname";
    $s=$dbo->conn->prepare($c);
    try{
        $s->execute([":tabname"=>$tabName]);
    }
    catch(PDOException $oo)
    {

    }
}
$dbo=new Database();
$c="create table student_details
(
    id int auto_increment primary key,
    reg_no varchar(20) unique,
    name varchar(50)
)";
$s=$dbo->conn->prepare($c);
try{
$s->execute();
echo("<br>student_details created");    
}
catch(PDOException $o)
{
    echo("<br>student_details not created");
}

$c="create table course_details
(
    id int auto_increment primary key,
    code varchar(20) unique,
    title varchar(50),
    credit int
)";
$s=$dbo->conn->prepare($c);
try{
$s->execute();
echo("<br>course_details created");    
}
catch(PDOException $o)
{
    echo("<br>course_details not created");
}

$c="create table staff_details
(
    id int auto_increment primary key,
    user_name varchar(20) unique,
    name varchar(100),
    password varchar(50)
)";
$s=$dbo->conn->prepare($c);
try{
$s->execute();
echo("<br>staff_details created");    
}
catch(PDOException $o)
{
    echo("<br>staff_details not created");
}

$c="create table session_details
(
    id int auto_increment primary key,
    year int,
    semester varchar(50),
    unique (year,semester)
)";
$s=$dbo->conn->prepare($c);
try{
$s->execute();
echo("<br>session_details created");    
}
catch(PDOException $o)
{
    echo("<br>session_details not created");
}

$c="create table course_registration
(
    student_id int,
    course_id int,
    session_id int,
    primary key (student_id,course_id,session_id)
)";
$s=$dbo->conn->prepare($c);
try{
$s->execute();
echo("<br>course_registration created");    
}
catch(PDOException $o)
{
    echo("<br>course_registration not created");
}


$c="create table course_allotment
(
    staff_id int,
    course_id int,
    session_id int,
    primary key (staff_id,course_id,session_id)
)";
$s=$dbo->conn->prepare($c);
try{
$s->execute();
echo("<br>course_allotment created");    
}
catch(PDOException $o)
{
    echo("<br>course_allotment not created");
}

$c="create table attendance_details
(
    staff_id int,
    course_id int,
    session_id int,
    student_id int,
    on_date date,
    status varchar(10),
    primary key (staff_id,course_id,session_id,student_id,on_date)
)";
$s=$dbo->conn->prepare($c);
try{
$s->execute();
echo("<br>attendance_details created");    
}
catch(PDOException $o)
{
    echo("<br>attendance_details not created");
}

$c="insert into student_details
(id,reg_no,name)
values
(1,'2021/248539','ABBA UCHECHUKWU EMMANUEL'),
(2,'2021/245835','ABEL CHUKWEMEKA GEORGE'),
(3,'2021/249126','ACHU CHIBUEZE CHRISTIAN'),
(4,'2021/242635','ADEEYO GOODNESS ADEDOJA'),
(5,'2021/247537','ADEKANMBI AYOMIDE'),
(6,'2021/249101','ADISHOME BLOSSOM'),
(7,'2021/248561','ADUKWU HARRISON CHIMEZIE'),
(8,'2021/243251','AFOR SUCCESS CHINOYEREM'),
(9,'2020/241097','AGBO CHUKWUEMERIE VICTOR'),
(10,'2021/249006','AGBO DIVINE CHIBUIKEM'),
(11,'2021/247433','AGBO VICTOR NNABUIKE'),
(12,'2021/245753','AGORYE EMMANUEL SAMARO'),

(13,'2021/249094','AGUGUESI DANIEL'),
(14,'2021/246666','AGUZURU EMMANUEL'),
(15,'2021/246707','AGWU CHIEDOZIE'),
(16,'2021/242738','AJIBO CHUKWUEMEKA SUNDAY'),
(17,'2021/249154','AJIBO CHUKWUNONSO OGBONNA'),
(18,'2021/247345','AJUONWU JOHNPAUL CHIEMERIE'),
(19,'2021/244988','AKA JUDE UGONNIA'),
(20,'2021/246213','AKAM MADUABUCHI STEPHEN'),
(21,'2021/242634','AKPA ONYEDIKACHUKWU MICHEL'),
(22,'2021/249436','AKPAH ALVIN OFUOWOICHO'),
(23,'2021/242683','ALARIBE CHIMAOBI'),
(24,'2010/248636','ALI JAHBUIKE SAMSON')"; 

$s=$dbo->conn->prepare($c);
try{
    $s->execute();
}
catch(PDOException $o)
{
    echo("<br>duplicate entry");
}


$c="insert into staff_details
(id,user_name,password,name)
values
(1,'izu','123','Mr Izuchukwu'),
(2,'bakpo','123','Prof F.S.Bakpo'),
(3,'okoronkwo','123','Dr Okoronkwo'),
(4,'obayi','123','Dr Obayi'),
(5,'aminat','123','Mrs Aminat'),
(6,'ani','123','Dr Anichebe')";


$s=$dbo->conn->prepare($c);
try{
    $s->execute();
}
catch(PDOException $o)
{
    echo("<br>duplicate entry");
}


$c="insert into session_details
(id,year,semester)
values
(1, 2025, 'FIRST SEMESTER'),
(2, 2025, 'SECOND SEMESTER')";


$s=$dbo->conn->prepare($c);
try{
    $s->execute();
}
catch(PDOException $o)
{
    echo("<br>duplicate entry");
}


$c="insert into course_details
(id,title,code,credit)
values
(1,'DATA AND COMPUTER COMMUNICATION','COS342',3),
(2,'OPERATING SYSTEM 1','COS334',3),
(3,'DATABASE DESIGN AND MANAGEMENT','COS324',3),
(4,'PROBLEM SOLVING','COS302',2),
(5,'COMPUTER NETWORKING SECURITY','COS344',3),
(6,'SOFTWARE ENGINEERING','COS336',2)";


$s=$dbo->conn->prepare($c);
try{
    $s->execute();
}
catch(PDOException $o)
{
    echo("<br>duplicate entry");
}

//if any record already there in the table delete them
clearTable($dbo,"course_registration");
$c="insert into course_registration
(student_id,course_id,session_id)
values
(:sid,:cid,:sessid)";
$s=$dbo->conn->prepare($c);

//iterate over all the 24 students
//for each of them chose max 3 random courses, from 1 to 6

for($i=1;$i<=24;$i++)
{
    for($j=0;$j<3;$j++)
    {
        $cid=rand(1,6);
        //insert the selected course into course_registration table for
        //session 1 and student_id $i
        try{
            $s->execute([":sid"=>$i,":cid"=>$cid,":sessid"=>1]);
        }
        catch(PDOException $pe)
        {

        }

        //repeat for session 2

        $cid=rand(1,6);
        //insert the selected course into course_registration table for
        //session 2 and student_id $i
        try{
            $s->execute([":sid"=>$i,":cid"=>$cid,":sessid"=>2]);
        }
        catch(PDOException $pe)
        {

        }

    }
}


//if any record already there in the table delete them
clearTable($dbo,"course_allotment");
$c="insert into course_allotment
(staff_id,course_id,session_id)
values
(:fid,:cid,:sessid)";
$s=$dbo->conn->prepare($c);

//iterate over all the 6 lecturers
//for each of them chose max 2 random courses, from 1 to 6

for($i=1;$i<=6;$i++)
{
    for($j=0;$j<2;$j++)
    {
        $cid=rand(1,6);
        //insert the selected course into course_allotment table for
        //session 1 and staff_id $i
        try{
            $s->execute([":fid"=>$i,":cid"=>$cid,":sessid"=>1]);
        }
        catch(PDOException $pe)
        {

        }

        //repeat for session 2

        $cid=rand(1,6);
        //insert the selected course into course_allotment table for
        //session 2 and student_id $i
        try{
            $s->execute([":fid"=>$i,":cid"=>$cid,":sessid"=>2]);
        }
        catch(PDOException $pe)
        {

        }

    }
}




?>