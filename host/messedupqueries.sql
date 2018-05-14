select * from payment;

/*Service Provider Registration Queries from here*/
INSERT INTO users (username, f_name, l_name, email_add,password,phone,acc_type,profile_img,birthday)
VALUES ("dominic@abang.com","nic "," tadpole","dominic@abang.com",12345678,+637559250700,"provider",null,DATE ("2017-05-05"));

select * from `service-provider`;

select * from users;
INSERT INTO `service-provider`(id,address,`business-permit`,`bank-acc-no`) VALUES (7,"CAR Benguet Baguio Bakakeng Central Diwata Street 47","null",123456789);
/*until here*/


INSERT INTO payment (`payment-date`, `amount`, `customer-id`) VALUES (DATE ("2011-05-05"),2000,3);
insert into house(`service-provider`,`address`,`no_CR`,`longitude`,`latitude`)
VALUE(2,"bahay",3,16.38418084926152,120.59318745595851);

insert into house(`service-provider`,`address`,`no_CR`,`longitude`,`latitude`)
VALUE(2,"bahay2",3,16.38418084926152,120.59318745595851);

insert into room(area,no_beds,house_id) VALUES(80,1,3);

/*Shows users that are service providers*/
select* from `service-provider` inner join users on `service-provider`.id=users.id;

/*shows rooms of house of service providers*/
select l_name,f_name from house inner join room on room.house_id=house.id inner join `service-provider` on 
house.`service-provider`=`service-provider`.id inner join users on `service-provider`.id=users.id;


/*inserting a house listing*/
insert into house(`service-provider`,`address`,`no_CR`,`longitude`,`latitude`)
VALUE(7,"bahay ni nic",2,16.38418084926152,120.59318745595851); /*created house 4*/

/*inserting a room listing*/
insert into room(area,no_beds,house_id) VALUES(80,1,4); /*adds one room to the house 4*/



/*Displays houses with their rooms and the id of their service providers */
select distinct house.id as "House ID", `service-provider` "Service Provider/User id",address "House Address", no_CR "Number of Comfort Rooms",longitude,latitude
from house inner join room on house.id=room.house_id;

/*Displays payment transactions and where the payment came from*/
select payment.id "Payment ID",`payment-date`,amount,`customer-id`,l_name,f_name 
from payment inner join users on users.id=payment.`customer-id`;
select * from room;

/*Displays payment transactions and where the payment came from and for what house/room the payment is for*/
select bookings.id "booking id",house_id "House id", `room-id` "Payment for room id",`date-booked` ,`check-in`,`check-out`,payment_id,
amount,bookings.`customer-id`,f_name"Payor First Name",l_name "Payor Last Name"
from bookings
inner join payment on payment.`customer-id`=bookings.`customer-id`
inner join users on bookings.`customer-id`=users.id
inner join room on `room-id`=room.id 
inner join house on house.id=room.house_id;

/*create a reservation*/
insert into reservations (`customer-id`,`room-id`,`date-reserved`,`check-in`,`check-out`,status)
VALUES (3,10,DATE("2018-12-12"),DATE("2018-12-12"),DATE("2018-12-13"),"booked");

/*Retrieve reservation based on service provider id, status may be equal to reserved or booked*/
select `customer-id`,l_name "Customer Last Name",f_name"Customer First Name",`service-provider`"Service Provider ID",house.id as "House ID",`room-id`,`date-reserved`,status
from reservations 
inner join users on  reservations.`customer-id`=users.id
inner join room on `room-id`=room.id
inner join house on room.house_id=house.id;








/*adding a new booking*/
insert into bookings(`customer-id`,`room-id`,`date-booked`,`check-in`,`check-out`,`payment_id`)
VALUES (3,10,DATE("2018-12-12"),DATE("2018-12-12"),DATE("2018-12-13"),1);