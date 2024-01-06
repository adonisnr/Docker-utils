#!/bin/bash

# Script para rodar uma instância PHP docker por um determinado tempo.
# Abordagem feita para usar com vscode.

CONTAINER_NAME='php82-geral'
CONTAINER_IMAGE='php82-php82:latest'

# CHECA SE TEM ALGUM CONTAINER NOMEADO DO DOCKER PHP.
if [ ! "$(docker ps -q -f name=$CONTAINER_NAME)" ]; then
	# SE NÃO HOUVER, CRIA AQUI
	docker run --rm -t -d -v $(pwd):/app -w /app --name $CONTAINER_NAME $CONTAINER_IMAGE > /dev/null 2>&1

	# DEIXA ATIVO POR 10 MIN.
	echo "docker stop $CONTAINER_NAME" | at now + 10 min > /dev/null 2>&1
fi

# RODA A REQUISIÇÃO DE DENTRO DO CONTAINER
docker exec --user 1000:1000 $CONTAINER_NAME php "$@"
