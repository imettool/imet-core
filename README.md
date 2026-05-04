# imet-core

<p align="center"><img alt="logo" src="/docs/icon.png" style="width: 200px;"></p>

The shared heart of the IMET platform which provides all assessment functionality to the hosting application, including all data models, 
database migrations, routes, controllers, views and frontend assets.

> [!IMPORTANT]
> This repository does not contain a standalone application. In order to execute this codebase, you need to integrate it 
> into a hosting laravel based application such as `imet-offline` or `imet-online`.

## Getting started
A complete and comprehensive documentation of the codebase is available [here](docs/documentation.md).

## Related codebases
- [IMET Offline Tool](https://github.com/imettool/imet-offline): desktop application integrating the IMET core codebase 
  for offline use. This is the most known implementation of the IMET tool, and it is widely used by conservation practitioners worldwide. 
  It is built using NativePHP, a brand-new framework for building cross-platform desktop applications with PHP.
- [IMET online](https://github.com/andreamarelli/imet_global): web application integrating the IMET core codebase for online use.

## Copyright
Copyright (C) 2026 European Union

## License
This package is licensed under the [EUPL-1.2 license](/LICENSE).
