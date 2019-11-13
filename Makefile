gen-go:
	thrift --gen go definition/inbox.thrift

gen-js:
	thrift --gen js definition/inbox.thrift

gen-nodejs:
	thrift --gen js:node definition/inbox.thrift

gen-php:
	thrift --gen php:psr4,server,validate definition/inbox.thrift

all: gen-go gen-js gen-nodejs gen-php

clean:
	rm -rf gen-*
