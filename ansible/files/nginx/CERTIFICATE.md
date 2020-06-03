## How to create a self-signed Certificate

#### Create a file called `v3.ext` with the following content. Update `DNS.*` is needed
```
authorityKeyIdentifier=keyid,issuer
basicConstraints=CA:FALSE
keyUsage = digitalSignature, nonRepudiation, keyEncipherment, dataEncipherment
subjectAltName = @alt_names

[alt_names]
DNS.1 = vanilla.local
DNS.2 = *.vanilla.local
IP= 192.168.99.10
```

#### Run the following commands

```
openssl genrsa -des3 -passout pass:12345678 -out vanilla-box.key.pass 4096
openssl rsa -passin pass:12345678 -in vanilla-box.key.pass -out vanilla-box.key
rm vanilla-box.key.pass
openssl req -new -key vanilla-box.key -out vanilla-box.csr
openssl x509 -req -sha256 -extfile v3.ext -days 825 -in vanilla-box.csr -signkey vanilla-box.key -out vanilla-box.crt
rm v3.ext
rm vanilla-box.csr
```
