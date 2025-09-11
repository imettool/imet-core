ARG COMPOSE_PROJECT_NAME
FROM ${COMPOSE_PROJECT_NAME}_php_image

# Use host user (to fix file permission). Required on Linux
ARG UID
RUN chown -R ${UID} /var/www/
USER ${UID}

CMD ["php", "artisan", "schedule:work"]
