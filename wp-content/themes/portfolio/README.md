# README

This README documents the requirements for begin-2022

- begin-2022
- Version 1.0.0
- https://www.bgn.agency

### Pre-install

- Clone begin-2022 files into your `theme` directory using `git clone https://bgnagency@bitbucket.org/bgnagency/begin-2022.git`
- Rename `begin-2022` theme folder name to a project specific reference

### How to install

- Change to the project's theme root directory.
- Install project dependencies with `yarn`
- BrowserSync - If you’re already running a local server with PHP or similar, you’ll need to use the proxy mode. Open webpack.config.js and replace `http://bgn-blank-wp:8888/` with your local development url
- Run Webpack with `yarn start` for development mode
- Compile production ready files with `yarn build`

### Who do I talk to?

- BGN
- Paul Bailey - paul@bgn.agency
