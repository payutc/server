propel-gen reverse # generate schema.xml from db
propel-gen om # generate classes
propel-gen sql # generate db sql structure
propel-gen insert-sql # load the structure in the db
propel-gen convert-conf # convert the runtime-conf.xml to php in build/conf/
propel-gen # run om, sql and convert-conf

propel-gen datadump # dump db data
propel-gen datasql # convert data.xmk to data.sql in build/sql/


