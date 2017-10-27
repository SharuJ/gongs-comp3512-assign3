USE `book`;

drop table if exists States;

create table States
(
StateId   smallint    unsigned not null auto_increment comment 'PK: State ID',
StateName varchar(32) not null comment 'State name with first letter capital',
StateAbbr varchar(8)  comment 'Optional state abbreviation (US 2 cap letters)',
primary key (StateId)
)
charset utf8
collate utf8_unicode_ci
;
 
insert into States
values
(NULL, 'Alabama', 'AL'),
(NULL, 'Alaska', 'AK'),
(NULL, 'Arizona', 'AZ'),
(NULL, 'Arkansas', 'AR'),
(NULL, 'California', 'CA'),
(NULL, 'Colorado', 'CO'),
(NULL, 'Connecticut', 'CT'),
(NULL, 'Delaware', 'DE'),
(NULL, 'District of Columbia', 'DC'),
(NULL, 'Florida', 'FL'),
(NULL, 'Georgia', 'GA'),
(NULL, 'Hawaii', 'HI'),
(NULL, 'Idaho', 'ID'),
(NULL, 'Illinois', 'IL'),
(NULL, 'Indiana', 'IN'),
(NULL, 'Iowa', 'IA'),
(NULL, 'Kansas', 'KS'),
(NULL, 'Kentucky', 'KY'),
(NULL, 'Louisiana', 'LA'),
(NULL, 'Maine', 'ME'),
(NULL, 'Maryland', 'MD'),
(NULL, 'Massachusetts', 'MA'),
(NULL, 'Michigan', 'MI'),
(NULL, 'Minnesota', 'MN'),
(NULL, 'Mississippi', 'MS'),
(NULL, 'Missouri', 'MO'),
(NULL, 'Montana', 'MT'),
(NULL, 'Nebraska', 'NE'),
(NULL, 'Nevada', 'NV'),
(NULL, 'New Hampshire', 'NH'),
(NULL, 'New Jersey', 'NJ'),
(NULL, 'New Mexico', 'NM'),
(NULL, 'New York', 'NY'),
(NULL, 'North Carolina', 'NC'),
(NULL, 'North Dakota', 'ND'),
(NULL, 'Ohio', 'OH'),
(NULL, 'Oklahoma', 'OK'),
(NULL, 'Oregon', 'OR'),
(NULL, 'Pennsylvania', 'PA'),
(NULL, 'Rhode Island', 'RI'),
(NULL, 'South Carolina', 'SC'),
(NULL, 'South Dakota', 'SD'),
(NULL, 'Tennessee', 'TN'),
(NULL, 'Texas', 'TX'),
(NULL, 'Utah', 'UT'),
(NULL, 'Vermont', 'VT'),
(NULL, 'Virginia', 'VA'),
(NULL, 'Washington', 'WA'),
(NULL, 'West Virginia', 'WV'),
(NULL, 'Wisconsin', 'WI'),
(NULL, 'Wyoming', 'WY')
;