#!/usr/bin/env bash
export PATH=$PATH:/usr/local/bin:/usr/local/sbin:/usr/sbin
bash /home/ec2-user/scripts/setup-beanstalk.sh
bash /home/ec2-user/scripts/setup-supervisor.sh