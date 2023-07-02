# QABox by 18120113

## Install

Clone Source Code

```bash
git clone git@github.com:iamncdai/qabox.git
cd qabox
docker-compose up -d
```

Database Configuration
- Access: `http://localhost:8080`
- Login with Username/Password: `root/root`
- Create Dabatase: `qabox`
- Import data from file: `db/qabox.sql`

The above is the default configuration, you can configure it in the following files:
- `docker-compose.yml`
- `qabox/config.inc`

Congratulations on completing the Website installation, access http://localhost:8000 to use.

## Libs
- jQuery (https://jquery.com/)
- jQuery Validate (https://jqueryvalidation.org/)
- Bootstrap (https://getbootstrap.com/docs/5.3/getting-started/introduction/)
- Toastr (https://codeseven.github.io/toastr/demo.html)
