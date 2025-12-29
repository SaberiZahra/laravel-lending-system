# Authenticating requests

To authenticate requests, include an **`Authorization`** header with the value **`"Bearer Bearer your_jwt_token_here"`**.

All authenticated endpoints are marked with a `requires authentication` badge in the documentation below.

Get your token by calling <code>POST /api/login</code> with username/email and password.
