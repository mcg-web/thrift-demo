gen-php:
	thrift --gen php:psr4 definition/inbox.thrift

gen-nodejs:
	thrift --gen node:js definition/inbox.thrift

gen-go:
	thrift --gen go definition/inbox.thrift
