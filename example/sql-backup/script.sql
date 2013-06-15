drop table if exists banner;

drop table if exists campaign;

drop table if exists size;

/*==============================================================*/
/* table: banner                                                */
/*==============================================================*/
create table banner
(
   banner_id            int not null auto_increment,
   size_id              int,
   campaign_id          int,
   banner_name          varchar(100),
   banner_version       int,
   banner_active        enum('y','n'),
   banner_url           varchar(255),
   primary key (banner_id)
);

/*==============================================================*/
/* table: campaign                                              */
/*==============================================================*/
create table campaign
(
   campaign_id          int not null auto_increment,
   campaign_name        varchar(100),
   created_at           timestamp,
   campaign_active      enum('y','n'),
   primary key (campaign_id)
);

/*==============================================================*/
/* table: size                                                  */
/*==============================================================*/
create table size
(
   size_id              int not null auto_increment,
   size_name            varchar(100),
   size_width           int,
   size_height          int,
   size_active          enum('y','n'),
   primary key (size_id)
);

alter table banner add constraint fk_reference_1 foreign key (size_id)
      references size (size_id) on delete restrict on update restrict;

alter table banner add constraint fk_reference_2 foreign key (campaign_id)
      references campaign (campaign_id) on delete restrict on update restrict;
