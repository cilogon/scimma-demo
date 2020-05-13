# scimma-demo
a CILogon OIDC demo app for https://scimma.github.io/IAM/Community/

This container inherits from https://github.com/cilogon/debian-openidc
that is published to https://hub.docker.com/r/cilogon/debian-openidc.

The index.php script checks the OIDC_CLAIM_isMemberOf claim to see if the authenticated user is an active member of the SCiMMA Community and to show if the user is a member of the Blue Team or Red Team.

## build the container
```
docker build -t scimma-demo .
```

## run the container
```
docker run --env-file ./scimma-demo-env.txt --name scimma-demo -p 80:80 -p 443:443 -it scimma-demo
```

## env-file
The container expects some environment variables to be defined:
```
$ cat scimma-demo-env.txt
CLIENTID=cilogon:/client_id/1234567890abcdef
CLIENTSECRET=yoursecretvaluefromclientregistration
REDIRECTURI=https://localhost.localdomain/oidc/redirect
SCOPE=openid email profile org.cilogon.userinfo
CRYPTOPASS=changeme
SERVERNAME=localhost.localdomain
EMAIL=demo@example.org
```

## https setup
If SERVERNAME is set to anything other than `localhost.localdomain` then certbot will try to get a Let's Encrypt certificate for Apache HTTPD 60 seconds after startup, so try to have DNS configured properly within the first 60 seconds.

## push to Docker Hub
```
git status # verify that my working tree is clean
git tag v0.1 # tag the new version
git push --tags # push the new tag to GitHub
docker build -t scimma-demo . # build the image
docker images # find the IMAGE ID
docker tag 5b06d34ca7b1 cilogon/scimma-demo:v0.1 # tag it
docker push cilogon/scimma-demo:v0.1 # push
