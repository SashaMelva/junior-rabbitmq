FROM rabbitmq:3-management
WORKDIR "/"

RUN apt-get update \
    && apt-get -y install nano

RUN rabbitmq-plugins enable rabbitmq_stomp
RUN rabbitmq-plugins enable rabbitmq_web_stomp