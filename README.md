Learning Service Mesh with Linkerd and Namerd.

## How to run

This project can be running locally with this command:

`docker-compose -f <docker-compose-file-name> -up -d --force-recreate --remove-orphans`

First all, you need to copy `./docker/env.yml.dist` to `./docker/env.yml` and change the environment variables requires.

### How to access admin

You can access it, using localhost `http://localhost:9990/admin` or specified domain names.

### Optional

Case you would configure domain name for services:

* assets.local (::80)
* metadatas.local (::82)
* uploads.local (::81)

There is another project with the same proposals called [Istio](https://istio.io/).

## Why I used Namerd?

`Linkerd` has support for dtab, but changes while this is running, you need will restart and using `Namerd`, you can change the host files without restarting him.

## Reference Links

* [Buoyant Linkerd](https://linkerd.io/)
* [Buoyant Linkerd](https://linkerd.io/)
* [Pattern Service Mesh](http://philcalcado.com/2017/08/03/pattern_service_mesh.html)
* [Istio](https://istio.io/)
* [What's a service mesh? And why do I need one?](https://blog.buoyant.io/2017/04/25/whats-a-service-mesh-and-why-do-i-need-one/)
* [What Is a Service Mesh?](https://www.nginx.com/blog/what-is-a-service-mesh/)

## Additional references that I studied
* [Finagle](https://twitter.github.io/finagle/)
* [Apache Thrift](https://thrift.apache.org/)

### Learnings

* Configure NGINX proxies
* Use Go Lang [Template](https://golang.org/pkg/text/template/) with Docker to retrieve IPs after scale service to multiple replicas.

```
docker inspect --format="{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}" $(docker ps -a -q --filter="name=<container-name>")
```

### Difficulties

* Configure dtab
* Configure interpreter to routers