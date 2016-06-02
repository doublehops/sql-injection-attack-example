#!/bin/bash

if [ -z "$1" ]
  then echo You must supply an instance to provision to prevent provisioning all hosts
       echo "Options are commonly: local_dev, test, prod, staging."
  exit;
fi

host=$1

ansible-playbook provisioners/playbook.yml -i "provisioners/ansible_hosts" --limit $host $2
