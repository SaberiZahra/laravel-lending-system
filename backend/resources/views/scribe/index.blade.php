<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Lending System API Documentation</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.print.css") }}" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
                    body .content .bash-example code { display: none; }
                    body .content .javascript-example code { display: none; }
            </style>

    <script>
        var tryItOutBaseUrl = "http://localhost:8000";
        var useCsrf = Boolean();
        var csrfUrl = "";
    </script>
    <script src="{{ asset("/vendor/scribe/js/tryitout-5.6.0.js") }}"></script>

    <script src="{{ asset("/vendor/scribe/js/theme-default-5.6.0.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;]">

<a href="#" id="nav-button">
    <span>
        MENU
        <img src="{{ asset("/vendor/scribe/images/navbar.png") }}" alt="navbar-image"/>
    </span>
</a>
<div class="tocify-wrapper">
    
            <div class="lang-selector">
                                            <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                    </div>
    
    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>

    <div id="toc">
                    <ul id="tocify-header-introduction" class="tocify-header">
                <li class="tocify-item level-1" data-unique="introduction">
                    <a href="#introduction">Introduction</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authenticating-requests" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authenticating-requests">
                    <a href="#authenticating-requests">Authenticating requests</a>
                </li>
                            </ul>
                    <ul id="tocify-header-general" class="tocify-header">
                <li class="tocify-item level-1" data-unique="general">
                    <a href="#general">General</a>
                </li>
                                    <ul id="tocify-subheader-general" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="general-GETapi-user">
                                <a href="#general-GETapi-user">GET api/user</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="general-POSTapi-register">
                                <a href="#general-POSTapi-register">Register a new user</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="general-POSTapi-login">
                                <a href="#general-POSTapi-login">Login user (supports login with either username or email)</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="general-GETapi-public-items">
                                <a href="#general-GETapi-public-items">Display all active items with their listings for public/guest users (homepage).</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="general-GETapi-public-listings">
                                <a href="#general-GETapi-public-listings">Display all active listings for public/guest users (homepage).</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="general-GETapi-public-listings-newest">
                                <a href="#general-GETapi-public-listings-newest">Get newest listings (ordered by created_at desc)</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="general-GETapi-public-listings-most-viewed">
                                <a href="#general-GETapi-public-listings-most-viewed">Get most viewed listings (ordered by view_count desc)</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="general-GETapi-public-listings-most-borrowed">
                                <a href="#general-GETapi-public-listings-most-borrowed">Get most borrowed listings (ordered by loans count)</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="general-GETapi-public-listings--id-">
                                <a href="#general-GETapi-public-listings--id-">Display a specific listing for public/guest users.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="general-GETapi-public-categories">
                                <a href="#general-GETapi-public-categories">Display all categories (with children for tree structure).</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="general-POSTapi-forgot-password">
                                <a href="#general-POSTapi-forgot-password">POST api/forgot-password</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="general-POSTapi-verify-reset-code">
                                <a href="#general-POSTapi-verify-reset-code">POST api/verify-reset-code</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="general-POSTapi-reset-password">
                                <a href="#general-POSTapi-reset-password">POST api/reset-password</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="general-POSTapi-logout">
                                <a href="#general-POSTapi-logout">Logout user (revoke all tokens)</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="general-GETapi-me">
                                <a href="#general-GETapi-me">Get authenticated user details</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="general-GETapi-profile">
                                <a href="#general-GETapi-profile">GET api/profile</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="general-PUTapi-profile">
                                <a href="#general-PUTapi-profile">PUT api/profile</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="general-GETapi-items">
                                <a href="#general-GETapi-items">Display a listing of the authenticated user's items.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="general-POSTapi-items">
                                <a href="#general-POSTapi-items">Store a newly created item for the authenticated user.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="general-GETapi-items--id-">
                                <a href="#general-GETapi-items--id-">Display the specified item (only if belongs to user).</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="general-PUTapi-items--id-">
                                <a href="#general-PUTapi-items--id-">Update the specified item (only if belongs to user).</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="general-DELETEapi-items--id-">
                                <a href="#general-DELETEapi-items--id-">Remove the specified item (soft delete).</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="general-GETapi-listings">
                                <a href="#general-GETapi-listings">Display listings of the authenticated user's items.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="general-POSTapi-listings">
                                <a href="#general-POSTapi-listings">Store a new listing for an item owned by the user.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="general-GETapi-listings--id-">
                                <a href="#general-GETapi-listings--id-">Display a specific listing (only if item belongs to user).</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="general-PUTapi-listings--id-">
                                <a href="#general-PUTapi-listings--id-">Update the listing.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="general-DELETEapi-listings--id-">
                                <a href="#general-DELETEapi-listings--id-">Soft delete the listing.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="general-GETapi-my-loans">
                                <a href="#general-GETapi-my-loans">Loans related to authenticated user</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="general-POSTapi-loans--loan_id--approve">
                                <a href="#general-POSTapi-loans--loan_id--approve">Approve loan</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="general-POSTapi-loans--loan_id--reject">
                                <a href="#general-POSTapi-loans--loan_id--reject">Reject loan</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="general-POSTapi-loans">
                                <a href="#general-POSTapi-loans">Create loan request</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="general-GETapi-loans--id-">
                                <a href="#general-GETapi-loans--id-">GET api/loans/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="general-GETapi-conversations">
                                <a href="#general-GETapi-conversations">GET api/conversations</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="general-GETapi-messages--conversation_id-">
                                <a href="#general-GETapi-messages--conversation_id-">GET api/messages/{conversation_id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="general-POSTapi-messages">
                                <a href="#general-POSTapi-messages">POST api/messages</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="general-GETapi-admin-conversation">
                                <a href="#general-GETapi-admin-conversation">Get or create conversation with admin (for support chat)</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="general-GETapi-admin-users">
                                <a href="#general-GETapi-admin-users">GET api/admin/users</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="general-GETapi-admin-users--user_id-">
                                <a href="#general-GETapi-admin-users--user_id-">GET api/admin/users/{user_id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="general-GETapi-admin-categories">
                                <a href="#general-GETapi-admin-categories">Display all categories (with children for tree structure).</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="general-POSTapi-admin-categories">
                                <a href="#general-POSTapi-admin-categories">Store a new category (Admin only)</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="general-GETapi-admin-categories--id-">
                                <a href="#general-GETapi-admin-categories--id-">Display a single category with its items.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="general-PUTapi-admin-categories--id-">
                                <a href="#general-PUTapi-admin-categories--id-">Update a category (Admin only)</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="general-DELETEapi-admin-categories--id-">
                                <a href="#general-DELETEapi-admin-categories--id-">Delete a category (Admin only)</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="general-PATCHapi-admin-users--user_id--trust-score">
                                <a href="#general-PATCHapi-admin-users--user_id--trust-score">PATCH api/admin/users/{user_id}/trust-score</a>
                            </li>
                                                                        </ul>
                            </ul>
            </div>

    <ul class="toc-footer" id="toc-footer">
                    <li style="padding-bottom: 5px;"><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li style="padding-bottom: 5px;"><a href="{{ route("scribe.openapi") }}">View OpenAPI spec</a></li>
                <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
    </ul>

    <ul class="toc-footer" id="last-updated">
        <li>Last updated: January 6, 2026</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="introduction">Introduction</h1>
<p>Complete API documentation for the lending platform (borrow/lend items).</p>
<aside>
    <strong>Base URL</strong>: <code>http://localhost:8000</code>
</aside>
<p>This API powers the Lending System platform where users can list items for rent, request loans, and chat.</p>
<p><strong>Authentication</strong>: All protected endpoints require a Bearer token obtained from <code>/api/login</code>.</p>
<p><strong>Base URL</strong>: <code>{{ config('app.url') }}/api</code></p>
<aside class="notice">
Tip: Use the "Try It Out" button to test endpoints directly in the browser.
Examples are available in JavaScript (fetch/axios) and cURL.
</aside>

        <h1 id="authenticating-requests">Authenticating requests</h1>
<p>To authenticate requests, include an <strong><code>Authorization</code></strong> header with the value <strong><code>"Bearer Bearer your_jwt_token_here"</code></strong>.</p>
<p>All authenticated endpoints are marked with a <code>requires authentication</code> badge in the documentation below.</p>
<p>Get your token by calling <code>POST /api/login</code> with username/email and password.</p>

        <h1 id="general">General</h1>

    

                                <h2 id="general-GETapi-user">GET api/user</h2>

<p>
</p>



<span id="example-requests-GETapi-user">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/user" \
    --header "Accept: application/json" \
    --header "Content-Type: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/user"
);

const headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-user">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://localhost:3000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-user" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-user"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-user"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-user" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-user">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-user" data-method="GET"
      data-path="api/user"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-user', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-user"
                    onclick="tryItOut('GETapi-user');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-user"
                    onclick="cancelTryOut('GETapi-user');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-user"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/user</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-user"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-user"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="general-POSTapi-register">Register a new user</h2>

<p>
</p>



<span id="example-requests-POSTapi-register">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/register" \
    --header "Accept: application/json" \
    --header "Content-Type: application/json" \
    --data "{
    \"full_name\": \"b\",
    \"username\": \"n\",
    \"email\": \"ashly64@example.com\",
    \"password\": \"pBNvYg\",
    \"phone\": \"h\",
    \"address\": \"architecto\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/register"
);

const headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
};

let body = {
    "full_name": "b",
    "username": "n",
    "email": "ashly64@example.com",
    "password": "pBNvYg",
    "phone": "h",
    "address": "architecto"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-register">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://localhost:3000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;User registered successfully&quot;,
    &quot;access_token&quot;: &quot;28|aV20h7tnYUp7Bi2Q1l5uGKOTP9nxn6DPa8APvCBY747b3d18&quot;,
    &quot;token_type&quot;: &quot;Bearer&quot;,
    &quot;user&quot;: {
        &quot;full_name&quot;: &quot;b&quot;,
        &quot;username&quot;: &quot;n&quot;,
        &quot;email&quot;: &quot;ashly64@example.com&quot;,
        &quot;phone&quot;: &quot;h&quot;,
        &quot;address&quot;: &quot;architecto&quot;,
        &quot;updated_at&quot;: &quot;2026-01-06T17:43:46.000000Z&quot;,
        &quot;created_at&quot;: &quot;2026-01-06T17:43:46.000000Z&quot;,
        &quot;id&quot;: 8
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-register" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-register"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-register"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-register" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-register">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-register" data-method="POST"
      data-path="api/register"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-register', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-register"
                    onclick="tryItOut('POSTapi-register');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-register"
                    onclick="cancelTryOut('POSTapi-register');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-register"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/register</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-register"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-register"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>full_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="full_name"                data-endpoint="POSTapi-register"
               value="b"
               data-component="body">
    <br>
<p>Must not be greater than 150 characters. Example: <code>b</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>username</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="username"                data-endpoint="POSTapi-register"
               value="n"
               data-component="body">
    <br>
<p>Must not be greater than 100 characters. Example: <code>n</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-register"
               value="ashly64@example.com"
               data-component="body">
    <br>
<p>Must be a valid email address. Must not be greater than 150 characters. Example: <code>ashly64@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-register"
               value="pBNvYg"
               data-component="body">
    <br>
<p>Must be at least 6 characters. Example: <code>pBNvYg</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phone</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="phone"                data-endpoint="POSTapi-register"
               value="h"
               data-component="body">
    <br>
<p>Must not be greater than 30 characters. Example: <code>h</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>address</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="address"                data-endpoint="POSTapi-register"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
        </form>

                    <h2 id="general-POSTapi-login">Login user (supports login with either username or email)</h2>

<p>
</p>



<span id="example-requests-POSTapi-login">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/login" \
    --header "Accept: application/json" \
    --header "Content-Type: application/json" \
    --data "{
    \"login\": \"architecto\",
    \"password\": \"|]|{+-\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/login"
);

const headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
};

let body = {
    "login": "architecto",
    "password": "|]|{+-"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-login">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://localhost:3000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Invalid credentials&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-login" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-login"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-login"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-login" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-login">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-login" data-method="POST"
      data-path="api/login"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-login', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-login"
                    onclick="tryItOut('POSTapi-login');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-login"
                    onclick="cancelTryOut('POSTapi-login');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-login"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/login</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>login</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="login"                data-endpoint="POSTapi-login"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-login"
               value="|]|{+-"
               data-component="body">
    <br>
<p>Can be username or email. Example: <code>|]|{+-</code></p>
        </div>
        </form>

                    <h2 id="general-GETapi-public-items">Display all active items with their listings for public/guest users (homepage).</h2>

<p>
</p>



<span id="example-requests-GETapi-public-items">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/public/items" \
    --header "Accept: application/json" \
    --header "Content-Type: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/public/items"
);

const headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-public-items">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://localhost:3000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">[
    {
        &quot;id&quot;: 3,
        &quot;owner_id&quot;: 3,
        &quot;category_id&quot;: 4,
        &quot;title&quot;: &quot;لپ&zwnj;تاپ Dell&quot;,
        &quot;description&quot;: &quot;لپ&zwnj;تاپ Dell با پردازنده Intel Core i7&quot;,
        &quot;item_condition&quot;: &quot;like_new&quot;,
        &quot;images_json&quot;: [
            &quot;http://localhost:3000/items/df5aa535e7670dd8789ca9b1d9135fe0.jpg&quot;
        ],
        &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;category&quot;: {
            &quot;id&quot;: 4,
            &quot;parent_id&quot;: null,
            &quot;title&quot;: &quot;الکترونیکی&quot;,
            &quot;description&quot;: &quot;وسایل الکترونیکی&quot;,
            &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
        },
        &quot;listings&quot;: [
            {
                &quot;id&quot;: 3,
                &quot;item_id&quot;: 3,
                &quot;title&quot;: &quot;اجاره لپ&zwnj;تاپ Dell&quot;,
                &quot;description&quot;: &quot;لپ&zwnj;تاپ با پردازنده قدرتمند&quot;,
                &quot;daily_fee&quot;: &quot;100000.00&quot;,
                &quot;deposit_amount&quot;: &quot;2000000.00&quot;,
                &quot;available_from&quot;: &quot;2026-01-05T00:00:00.000000Z&quot;,
                &quot;available_until&quot;: &quot;2026-03-05T00:00:00.000000Z&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;view_count&quot;: 86,
                &quot;created_at&quot;: &quot;2026-01-05T06:50:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T10:37:46.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        ]
    },
    {
        &quot;id&quot;: 4,
        &quot;owner_id&quot;: 4,
        &quot;category_id&quot;: 6,
        &quot;title&quot;: &quot;دوچرخه کوهستان&quot;,
        &quot;description&quot;: &quot;دوچرخه کوهستان با کیفیت عالی&quot;,
        &quot;item_condition&quot;: &quot;used&quot;,
        &quot;images_json&quot;: [
            &quot;http://localhost:3000/items/bc2bb19f872f60496b11c3bac04fd520.jpg&quot;
        ],
        &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;category&quot;: {
            &quot;id&quot;: 6,
            &quot;parent_id&quot;: null,
            &quot;title&quot;: &quot;ورزشی&quot;,
            &quot;description&quot;: &quot;وسایل ورزشی&quot;,
            &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
        },
        &quot;listings&quot;: [
            {
                &quot;id&quot;: 4,
                &quot;item_id&quot;: 4,
                &quot;title&quot;: &quot;اجاره دوچرخه کوهستان&quot;,
                &quot;description&quot;: &quot;دوچرخه مناسب برای کوهنوردی&quot;,
                &quot;daily_fee&quot;: &quot;50000.00&quot;,
                &quot;deposit_amount&quot;: &quot;500000.00&quot;,
                &quot;available_from&quot;: &quot;2026-01-05T00:00:00.000000Z&quot;,
                &quot;available_until&quot;: &quot;2026-05-05T00:00:00.000000Z&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;view_count&quot;: 58,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T07:17:54.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        ]
    },
    {
        &quot;id&quot;: 5,
        &quot;owner_id&quot;: 1,
        &quot;category_id&quot;: 3,
        &quot;title&quot;: &quot;جارو برقی&quot;,
        &quot;description&quot;: &quot;جارو برقی قدرتمند&quot;,
        &quot;item_condition&quot;: &quot;like_new&quot;,
        &quot;images_json&quot;: [
            &quot;http://localhost:3000/items/b899ad0b235bc522afea8ff39c81790f.jpg&quot;
        ],
        &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;category&quot;: {
            &quot;id&quot;: 3,
            &quot;parent_id&quot;: null,
            &quot;title&quot;: &quot;لوازم خانگی&quot;,
            &quot;description&quot;: &quot;لوازم خانگی&quot;,
            &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
        },
        &quot;listings&quot;: [
            {
                &quot;id&quot;: 5,
                &quot;item_id&quot;: 5,
                &quot;title&quot;: &quot;اجاره جارو برقی&quot;,
                &quot;description&quot;: &quot;جارو برقی قدرتمند&quot;,
                &quot;daily_fee&quot;: &quot;20000.00&quot;,
                &quot;deposit_amount&quot;: &quot;300000.00&quot;,
                &quot;available_from&quot;: &quot;2026-01-05T00:00:00.000000Z&quot;,
                &quot;available_until&quot;: &quot;2026-06-05T00:00:00.000000Z&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;view_count&quot;: 35,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T12:42:40.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        ]
    },
    {
        &quot;id&quot;: 6,
        &quot;owner_id&quot;: 2,
        &quot;category_id&quot;: 5,
        &quot;title&quot;: &quot;پازل 1000 تکه&quot;,
        &quot;description&quot;: &quot;پازل زیبا با تصویر طبیعت&quot;,
        &quot;item_condition&quot;: &quot;new&quot;,
        &quot;images_json&quot;: [
            &quot;http://localhost:3000/items/6e6afbf4e39d88e8f1d377de945c82fa.jpg&quot;
        ],
        &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;category&quot;: {
            &quot;id&quot;: 5,
            &quot;parent_id&quot;: null,
            &quot;title&quot;: &quot;اسباب بازی&quot;,
            &quot;description&quot;: &quot;اسباب بازی&zwnj;ها&quot;,
            &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
        },
        &quot;listings&quot;: [
            {
                &quot;id&quot;: 6,
                &quot;item_id&quot;: 6,
                &quot;title&quot;: &quot;اجاره پازل 1000 تکه&quot;,
                &quot;description&quot;: &quot;پازل زیبا و سرگرم&zwnj;کننده&quot;,
                &quot;daily_fee&quot;: &quot;10000.00&quot;,
                &quot;deposit_amount&quot;: &quot;100000.00&quot;,
                &quot;available_from&quot;: &quot;2026-01-05T00:00:00.000000Z&quot;,
                &quot;available_until&quot;: &quot;2026-07-05T00:00:00.000000Z&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;view_count&quot;: 27,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T11:57:17.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        ]
    },
    {
        &quot;id&quot;: 7,
        &quot;owner_id&quot;: 3,
        &quot;category_id&quot;: 2,
        &quot;title&quot;: &quot;ابزار جنگلی&quot;,
        &quot;description&quot;: &quot;برای یک گردش امن و باصفا در جنگل&quot;,
        &quot;item_condition&quot;: &quot;used&quot;,
        &quot;images_json&quot;: [
            &quot;http://localhost:3000/items/89fb9d307d6332a1c533d2dfa23ce554.jpg&quot;
        ],
        &quot;created_at&quot;: &quot;2026-01-05T13:56:31.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-05T13:56:39.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;category&quot;: {
            &quot;id&quot;: 2,
            &quot;parent_id&quot;: null,
            &quot;title&quot;: &quot;ابزار&quot;,
            &quot;description&quot;: &quot;ابزارهای مختلف&quot;,
            &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-06T08:52:05.000000Z&quot;
        },
        &quot;listings&quot;: [
            {
                &quot;id&quot;: 8,
                &quot;item_id&quot;: 7,
                &quot;title&quot;: &quot;ابزار جنگلی&quot;,
                &quot;description&quot;: &quot;برای یک گردش امن و باصفا در جنگل&quot;,
                &quot;daily_fee&quot;: &quot;44808.00&quot;,
                &quot;deposit_amount&quot;: &quot;431398.00&quot;,
                &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
                &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;view_count&quot;: 0,
                &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        ]
    },
    {
        &quot;id&quot;: 8,
        &quot;owner_id&quot;: 4,
        &quot;category_id&quot;: 5,
        &quot;title&quot;: &quot;عروسک ببعی&quot;,
        &quot;description&quot;: &quot;دوست مهربان و نرم کودکان&quot;,
        &quot;item_condition&quot;: &quot;new&quot;,
        &quot;images_json&quot;: [
            &quot;http://localhost:3000/items/0c16e7cbc7d74492d92dc71a97634258.jpg&quot;
        ],
        &quot;created_at&quot;: &quot;2026-01-06T13:56:44.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-06T13:56:47.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;category&quot;: {
            &quot;id&quot;: 5,
            &quot;parent_id&quot;: null,
            &quot;title&quot;: &quot;اسباب بازی&quot;,
            &quot;description&quot;: &quot;اسباب بازی&zwnj;ها&quot;,
            &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
        },
        &quot;listings&quot;: [
            {
                &quot;id&quot;: 9,
                &quot;item_id&quot;: 8,
                &quot;title&quot;: &quot;عروسک ببعی&quot;,
                &quot;description&quot;: &quot;دوست مهربان و نرم کودکان&quot;,
                &quot;daily_fee&quot;: &quot;6714.00&quot;,
                &quot;deposit_amount&quot;: &quot;123502.00&quot;,
                &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
                &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;view_count&quot;: 2,
                &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T11:33:47.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        ]
    },
    {
        &quot;id&quot;: 10,
        &quot;owner_id&quot;: 2,
        &quot;category_id&quot;: 5,
        &quot;title&quot;: &quot;جورچین کودکان&quot;,
        &quot;description&quot;: &quot;یک قلعه هزار رنگ بسازید و آخر هفته خود را شیرین&zwnj;تر کنید&quot;,
        &quot;item_condition&quot;: &quot;used&quot;,
        &quot;images_json&quot;: [
            &quot;http://localhost:3000/items/2ad2e0775fe81e8fe6a4ccefc6636ee2.jpg&quot;
        ],
        &quot;created_at&quot;: &quot;2026-01-05T13:56:57.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-05T13:57:00.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;category&quot;: {
            &quot;id&quot;: 5,
            &quot;parent_id&quot;: null,
            &quot;title&quot;: &quot;اسباب بازی&quot;,
            &quot;description&quot;: &quot;اسباب بازی&zwnj;ها&quot;,
            &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
        },
        &quot;listings&quot;: [
            {
                &quot;id&quot;: 11,
                &quot;item_id&quot;: 10,
                &quot;title&quot;: &quot;جورچین کودکان&quot;,
                &quot;description&quot;: &quot;یک قلعه هزار رنگ بسازید و آخر هفته خود را شیرین&zwnj;تر کنید&quot;,
                &quot;daily_fee&quot;: &quot;12267.00&quot;,
                &quot;deposit_amount&quot;: &quot;165970.00&quot;,
                &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
                &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;view_count&quot;: 10,
                &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T17:14:58.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        ]
    },
    {
        &quot;id&quot;: 11,
        &quot;owner_id&quot;: 2,
        &quot;category_id&quot;: 6,
        &quot;title&quot;: &quot;بدنسازی در خانه&quot;,
        &quot;description&quot;: &quot;برای ورک اوت در گاراژ خانه شما&quot;,
        &quot;item_condition&quot;: &quot;old&quot;,
        &quot;images_json&quot;: [
            &quot;http://localhost:3000/items/4d7fad73122f9185ce985bff268529c3.jpg&quot;
        ],
        &quot;created_at&quot;: &quot;2026-01-05T13:57:04.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-05T13:57:07.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;category&quot;: {
            &quot;id&quot;: 6,
            &quot;parent_id&quot;: null,
            &quot;title&quot;: &quot;ورزشی&quot;,
            &quot;description&quot;: &quot;وسایل ورزشی&quot;,
            &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
        },
        &quot;listings&quot;: [
            {
                &quot;id&quot;: 12,
                &quot;item_id&quot;: 11,
                &quot;title&quot;: &quot;بدنسازی در خانه&quot;,
                &quot;description&quot;: &quot;برای ورک اوت در گاراژ خانه شما&quot;,
                &quot;daily_fee&quot;: &quot;29384.00&quot;,
                &quot;deposit_amount&quot;: &quot;171267.00&quot;,
                &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
                &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;view_count&quot;: 4,
                &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T12:38:48.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        ]
    },
    {
        &quot;id&quot;: 12,
        &quot;owner_id&quot;: 4,
        &quot;category_id&quot;: 2,
        &quot;title&quot;: &quot;ابزار محاسبات&quot;,
        &quot;description&quot;: &quot;به عنوان یک کابینت&zwnj;ساز به دردتان می&zwnj;خورد&quot;,
        &quot;item_condition&quot;: &quot;used&quot;,
        &quot;images_json&quot;: [
            &quot;http://localhost:3000/items/63a85aa0fde2237860b17411c6d4c057.jpg&quot;
        ],
        &quot;created_at&quot;: &quot;2026-01-05T13:57:10.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-05T13:57:13.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;category&quot;: {
            &quot;id&quot;: 2,
            &quot;parent_id&quot;: null,
            &quot;title&quot;: &quot;ابزار&quot;,
            &quot;description&quot;: &quot;ابزارهای مختلف&quot;,
            &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-06T08:52:05.000000Z&quot;
        },
        &quot;listings&quot;: [
            {
                &quot;id&quot;: 13,
                &quot;item_id&quot;: 12,
                &quot;title&quot;: &quot;ابزار محاسبات&quot;,
                &quot;description&quot;: &quot;به عنوان یک کابینت&zwnj;ساز به دردتان می&zwnj;خورد&quot;,
                &quot;daily_fee&quot;: &quot;37482.00&quot;,
                &quot;deposit_amount&quot;: &quot;720663.00&quot;,
                &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
                &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;view_count&quot;: 4,
                &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T10:33:30.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        ]
    },
    {
        &quot;id&quot;: 13,
        &quot;owner_id&quot;: 3,
        &quot;category_id&quot;: 5,
        &quot;title&quot;: &quot;فیل چوبی&quot;,
        &quot;description&quot;: &quot;اسباب بازی دستساز و بی&zwnj;نهایت زیبای فیلی&quot;,
        &quot;item_condition&quot;: &quot;like_new&quot;,
        &quot;images_json&quot;: [
            &quot;http://localhost:3000/items/95eb311980d9d95e7ae52f0a737e775b.jpg&quot;
        ],
        &quot;created_at&quot;: &quot;2026-01-05T13:57:16.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-05T13:57:20.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;category&quot;: {
            &quot;id&quot;: 5,
            &quot;parent_id&quot;: null,
            &quot;title&quot;: &quot;اسباب بازی&quot;,
            &quot;description&quot;: &quot;اسباب بازی&zwnj;ها&quot;,
            &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
        },
        &quot;listings&quot;: [
            {
                &quot;id&quot;: 14,
                &quot;item_id&quot;: 13,
                &quot;title&quot;: &quot;فیل چوبی&quot;,
                &quot;description&quot;: &quot;اسباب بازی دستساز و بی&zwnj;نهایت زیبای فیلی&quot;,
                &quot;daily_fee&quot;: &quot;13859.00&quot;,
                &quot;deposit_amount&quot;: &quot;104893.00&quot;,
                &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
                &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;view_count&quot;: 0,
                &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        ]
    },
    {
        &quot;id&quot;: 14,
        &quot;owner_id&quot;: 4,
        &quot;category_id&quot;: 5,
        &quot;title&quot;: &quot;موجودات ریز و بانمک&quot;,
        &quot;description&quot;: &quot;بچه&zwnj;های خود را به دنیایی از عجایت رنگارنگ بیاورید و اینطور داستان بگویید&quot;,
        &quot;item_condition&quot;: &quot;like_new&quot;,
        &quot;images_json&quot;: [
            &quot;http://localhost:3000/items/546e1a781d354475da98753ca33984ab.jpg&quot;
        ],
        &quot;created_at&quot;: &quot;2026-01-05T13:57:23.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-05T13:57:27.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;category&quot;: {
            &quot;id&quot;: 5,
            &quot;parent_id&quot;: null,
            &quot;title&quot;: &quot;اسباب بازی&quot;,
            &quot;description&quot;: &quot;اسباب بازی&zwnj;ها&quot;,
            &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
        },
        &quot;listings&quot;: [
            {
                &quot;id&quot;: 15,
                &quot;item_id&quot;: 14,
                &quot;title&quot;: &quot;موجودات ریز و بانمک&quot;,
                &quot;description&quot;: &quot;بچه&zwnj;های خود را به دنیایی از عجایت رنگارنگ بیاورید و اینطور داستان بگویید&quot;,
                &quot;daily_fee&quot;: &quot;9647.00&quot;,
                &quot;deposit_amount&quot;: &quot;149999.00&quot;,
                &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
                &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;view_count&quot;: 2,
                &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T11:21:43.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        ]
    },
    {
        &quot;id&quot;: 15,
        &quot;owner_id&quot;: 1,
        &quot;category_id&quot;: 1,
        &quot;title&quot;: &quot;کتابی خیال&zwnj;انگیز&quot;,
        &quot;description&quot;: &quot;برای خانم&zwnj;هایی که زیاد اورتینک می&zwnj;کنند.&quot;,
        &quot;item_condition&quot;: &quot;used&quot;,
        &quot;images_json&quot;: [
            &quot;http://localhost:3000/items/42151b6bb9ae2be8e2e08864a0bfacc1.jpg&quot;
        ],
        &quot;created_at&quot;: &quot;2026-01-05T13:57:31.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-05T13:57:34.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;category&quot;: {
            &quot;id&quot;: 1,
            &quot;parent_id&quot;: null,
            &quot;title&quot;: &quot;کتاب&quot;,
            &quot;description&quot;: &quot;کتاب&zwnj;های مختلف&quot;,
            &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
        },
        &quot;listings&quot;: [
            {
                &quot;id&quot;: 16,
                &quot;item_id&quot;: 15,
                &quot;title&quot;: &quot;کتابی خیال&zwnj;انگیز&quot;,
                &quot;description&quot;: &quot;برای خانم&zwnj;هایی که زیاد اورتینک می&zwnj;کنند.&quot;,
                &quot;daily_fee&quot;: &quot;7280.00&quot;,
                &quot;deposit_amount&quot;: &quot;61188.00&quot;,
                &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
                &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;view_count&quot;: 2,
                &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T11:31:35.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        ]
    },
    {
        &quot;id&quot;: 16,
        &quot;owner_id&quot;: 2,
        &quot;category_id&quot;: 5,
        &quot;title&quot;: &quot;مکعب روبیک&quot;,
        &quot;description&quot;: &quot;اگر نوجوانتان باهوش هست این مناسب شماست&quot;,
        &quot;item_condition&quot;: &quot;new&quot;,
        &quot;images_json&quot;: [
            &quot;http://localhost:3000/items/78371c77f1a3d7f9ded200c18242ae4e.jpg&quot;
        ],
        &quot;created_at&quot;: &quot;2026-01-05T13:57:38.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-05T13:57:41.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;category&quot;: {
            &quot;id&quot;: 5,
            &quot;parent_id&quot;: null,
            &quot;title&quot;: &quot;اسباب بازی&quot;,
            &quot;description&quot;: &quot;اسباب بازی&zwnj;ها&quot;,
            &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
        },
        &quot;listings&quot;: [
            {
                &quot;id&quot;: 17,
                &quot;item_id&quot;: 16,
                &quot;title&quot;: &quot;مکعب روبیک&quot;,
                &quot;description&quot;: &quot;اگر نوجوانتان باهوش هست این مناسب شماست&quot;,
                &quot;daily_fee&quot;: &quot;5806.00&quot;,
                &quot;deposit_amount&quot;: &quot;262822.00&quot;,
                &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
                &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;view_count&quot;: 0,
                &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        ]
    },
    {
        &quot;id&quot;: 17,
        &quot;owner_id&quot;: 3,
        &quot;category_id&quot;: 6,
        &quot;title&quot;: &quot;اسکیت&zwnj;بورد گروهی&quot;,
        &quot;description&quot;: &quot;با اکیپ دوستانتان این ورزش جادویی را تجربه کنید&quot;,
        &quot;item_condition&quot;: &quot;used&quot;,
        &quot;images_json&quot;: [
            &quot;http://localhost:3000/items/293212be4ddd17d68acbfaac78d56586.jpg&quot;
        ],
        &quot;created_at&quot;: &quot;2026-01-06T14:23:19.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-06T14:23:24.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;category&quot;: {
            &quot;id&quot;: 6,
            &quot;parent_id&quot;: null,
            &quot;title&quot;: &quot;ورزشی&quot;,
            &quot;description&quot;: &quot;وسایل ورزشی&quot;,
            &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
        },
        &quot;listings&quot;: [
            {
                &quot;id&quot;: 18,
                &quot;item_id&quot;: 17,
                &quot;title&quot;: &quot;اسکیت&zwnj;بورد گروهی&quot;,
                &quot;description&quot;: &quot;با اکیپ دوستانتان این ورزش جادویی را تجربه کنید&quot;,
                &quot;daily_fee&quot;: &quot;36573.00&quot;,
                &quot;deposit_amount&quot;: &quot;440176.00&quot;,
                &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
                &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;view_count&quot;: 0,
                &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        ]
    },
    {
        &quot;id&quot;: 18,
        &quot;owner_id&quot;: 4,
        &quot;category_id&quot;: 6,
        &quot;title&quot;: &quot;ایروبیک در خانه&quot;,
        &quot;description&quot;: &quot;کلاس های آنلاین ورزش رات ثبت نام کرده و همیشه در خانه فیت بمانید&quot;,
        &quot;item_condition&quot;: &quot;new&quot;,
        &quot;images_json&quot;: [
            &quot;http://localhost:3000/items/881611da63292e272aa6564a237e5e08.jpg&quot;
        ],
        &quot;created_at&quot;: &quot;2026-01-05T13:57:44.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-05T13:57:48.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;category&quot;: {
            &quot;id&quot;: 6,
            &quot;parent_id&quot;: null,
            &quot;title&quot;: &quot;ورزشی&quot;,
            &quot;description&quot;: &quot;وسایل ورزشی&quot;,
            &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
        },
        &quot;listings&quot;: [
            {
                &quot;id&quot;: 19,
                &quot;item_id&quot;: 18,
                &quot;title&quot;: &quot;ایروبیک در خانه&quot;,
                &quot;description&quot;: &quot;کلاس های آنلاین ورزش رات ثبت نام کرده و همیشه در خانه فیت بمانید&quot;,
                &quot;daily_fee&quot;: &quot;20369.00&quot;,
                &quot;deposit_amount&quot;: &quot;497940.00&quot;,
                &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
                &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;view_count&quot;: 4,
                &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T12:01:44.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        ]
    },
    {
        &quot;id&quot;: 19,
        &quot;owner_id&quot;: 2,
        &quot;category_id&quot;: 1,
        &quot;title&quot;: &quot;هملت&quot;,
        &quot;description&quot;: &quot;نمایشنامه&zwnj;ای از اعماق تاریخ و هنر&quot;,
        &quot;item_condition&quot;: &quot;old&quot;,
        &quot;images_json&quot;: [
            &quot;http://localhost:3000/items/1994376031428450fa5c2ac09eb4149c.jpg&quot;
        ],
        &quot;created_at&quot;: &quot;2026-01-05T13:57:51.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-06T13:57:54.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;category&quot;: {
            &quot;id&quot;: 1,
            &quot;parent_id&quot;: null,
            &quot;title&quot;: &quot;کتاب&quot;,
            &quot;description&quot;: &quot;کتاب&zwnj;های مختلف&quot;,
            &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
        },
        &quot;listings&quot;: [
            {
                &quot;id&quot;: 20,
                &quot;item_id&quot;: 19,
                &quot;title&quot;: &quot;هملت&quot;,
                &quot;description&quot;: &quot;نمایشنامه&zwnj;ای از اعماق تاریخ و هنر&quot;,
                &quot;daily_fee&quot;: &quot;7466.00&quot;,
                &quot;deposit_amount&quot;: &quot;199262.00&quot;,
                &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
                &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;view_count&quot;: 5,
                &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T12:42:45.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        ]
    },
    {
        &quot;id&quot;: 20,
        &quot;owner_id&quot;: 1,
        &quot;category_id&quot;: 6,
        &quot;title&quot;: &quot;اسکیت&zwnj;بورد نوستالژی&quot;,
        &quot;description&quot;: &quot;مدتیه که گوشه اتاق مونده و اگه لازمش دارید بهتون قرض میدم&quot;,
        &quot;item_condition&quot;: &quot;old&quot;,
        &quot;images_json&quot;: [
            &quot;http://localhost:3000/items/a22eda8cc9e2e7629fdeed8a2180183b.jpg&quot;
        ],
        &quot;created_at&quot;: &quot;2026-01-04T13:57:57.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-05T13:58:00.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;category&quot;: {
            &quot;id&quot;: 6,
            &quot;parent_id&quot;: null,
            &quot;title&quot;: &quot;ورزشی&quot;,
            &quot;description&quot;: &quot;وسایل ورزشی&quot;,
            &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
        },
        &quot;listings&quot;: [
            {
                &quot;id&quot;: 21,
                &quot;item_id&quot;: 20,
                &quot;title&quot;: &quot;اسکیت&zwnj;بورد نوستالژی&quot;,
                &quot;description&quot;: &quot;مدتیه که گوشه اتاق مونده و اگه لازمش دارید بهتون قرض میدم&quot;,
                &quot;daily_fee&quot;: &quot;36047.00&quot;,
                &quot;deposit_amount&quot;: &quot;404534.00&quot;,
                &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
                &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;view_count&quot;: 2,
                &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T11:29:11.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        ]
    },
    {
        &quot;id&quot;: 21,
        &quot;owner_id&quot;: 3,
        &quot;category_id&quot;: 1,
        &quot;title&quot;: &quot;سیمون دوبووار&quot;,
        &quot;description&quot;: &quot;اگر به ادبیات سیاسی علاقه مندید این کتاب مناسب شماست&quot;,
        &quot;item_condition&quot;: &quot;new&quot;,
        &quot;images_json&quot;: [
            &quot;http://localhost:3000/items/b5ede21269b3c45015526682602dc1eb.jpg&quot;
        ],
        &quot;created_at&quot;: &quot;2026-01-02T13:58:02.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-06T13:58:07.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;category&quot;: {
            &quot;id&quot;: 1,
            &quot;parent_id&quot;: null,
            &quot;title&quot;: &quot;کتاب&quot;,
            &quot;description&quot;: &quot;کتاب&zwnj;های مختلف&quot;,
            &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
        },
        &quot;listings&quot;: [
            {
                &quot;id&quot;: 22,
                &quot;item_id&quot;: 21,
                &quot;title&quot;: &quot;سیمون دوبووار&quot;,
                &quot;description&quot;: &quot;اگر به ادبیات سیاسی علاقه مندید این کتاب مناسب شماست&quot;,
                &quot;daily_fee&quot;: &quot;4032.00&quot;,
                &quot;deposit_amount&quot;: &quot;192781.00&quot;,
                &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
                &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;view_count&quot;: 6,
                &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T12:39:24.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        ]
    },
    {
        &quot;id&quot;: 22,
        &quot;owner_id&quot;: 4,
        &quot;category_id&quot;: 1,
        &quot;title&quot;: &quot;امیلی برانت&quot;,
        &quot;description&quot;: &quot;داستانی پر ابهام و خیال انگیز&quot;,
        &quot;item_condition&quot;: &quot;like_new&quot;,
        &quot;images_json&quot;: [
            &quot;http://localhost:3000/items/ce68c376ee804404db4d0c82bc242706.jpg&quot;
        ],
        &quot;created_at&quot;: &quot;2026-01-01T13:58:10.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-05T13:58:17.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;category&quot;: {
            &quot;id&quot;: 1,
            &quot;parent_id&quot;: null,
            &quot;title&quot;: &quot;کتاب&quot;,
            &quot;description&quot;: &quot;کتاب&zwnj;های مختلف&quot;,
            &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
        },
        &quot;listings&quot;: [
            {
                &quot;id&quot;: 23,
                &quot;item_id&quot;: 22,
                &quot;title&quot;: &quot;امیلی برانت&quot;,
                &quot;description&quot;: &quot;داستانی پر ابهام و خیال انگیز&quot;,
                &quot;daily_fee&quot;: &quot;6502.00&quot;,
                &quot;deposit_amount&quot;: &quot;122042.00&quot;,
                &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
                &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;view_count&quot;: 1,
                &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T11:43:44.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        ]
    },
    {
        &quot;id&quot;: 23,
        &quot;owner_id&quot;: 1,
        &quot;category_id&quot;: 6,
        &quot;title&quot;: &quot;دست&zwnj;های قوی&quot;,
        &quot;description&quot;: &quot;برای اوقات بیکاری  شما&quot;,
        &quot;item_condition&quot;: &quot;new&quot;,
        &quot;images_json&quot;: &quot;[\&quot;http://localhost:3000/items/e05812eb7d02bcbf8cafd0cfee380da0.jpg\&quot;]&quot;,
        &quot;created_at&quot;: &quot;2026-01-06T13:58:20.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-06T11:12:16.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;category&quot;: {
            &quot;id&quot;: 6,
            &quot;parent_id&quot;: null,
            &quot;title&quot;: &quot;ورزشی&quot;,
            &quot;description&quot;: &quot;وسایل ورزشی&quot;,
            &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
        },
        &quot;listings&quot;: [
            {
                &quot;id&quot;: 24,
                &quot;item_id&quot;: 23,
                &quot;title&quot;: &quot;دست&zwnj;های قوی&quot;,
                &quot;description&quot;: &quot;برای اوقات بیکاری  شما&quot;,
                &quot;daily_fee&quot;: &quot;27996.00&quot;,
                &quot;deposit_amount&quot;: &quot;283772.00&quot;,
                &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
                &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;view_count&quot;: 20,
                &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T12:30:18.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        ]
    },
    {
        &quot;id&quot;: 24,
        &quot;owner_id&quot;: 3,
        &quot;category_id&quot;: 2,
        &quot;title&quot;: &quot;آچار&quot;,
        &quot;description&quot;: &quot;برای تعمیرات خانگی&quot;,
        &quot;item_condition&quot;: &quot;used&quot;,
        &quot;images_json&quot;: [
            &quot;http://localhost:3000/items/ee501960fefe13840a013f3c18589c77.jpg&quot;
        ],
        &quot;created_at&quot;: &quot;2026-01-07T13:58:26.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-05T13:58:29.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;category&quot;: {
            &quot;id&quot;: 2,
            &quot;parent_id&quot;: null,
            &quot;title&quot;: &quot;ابزار&quot;,
            &quot;description&quot;: &quot;ابزارهای مختلف&quot;,
            &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-06T08:52:05.000000Z&quot;
        },
        &quot;listings&quot;: [
            {
                &quot;id&quot;: 25,
                &quot;item_id&quot;: 24,
                &quot;title&quot;: &quot;آچار&quot;,
                &quot;description&quot;: &quot;برای تعمیرات خانگی&quot;,
                &quot;daily_fee&quot;: &quot;19783.00&quot;,
                &quot;deposit_amount&quot;: &quot;193278.00&quot;,
                &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
                &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;view_count&quot;: 18,
                &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T12:36:48.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        ]
    },
    {
        &quot;id&quot;: 25,
        &quot;owner_id&quot;: 2,
        &quot;category_id&quot;: 2,
        &quot;title&quot;: &quot;ابزار نجاری&quot;,
        &quot;description&quot;: &quot;یک صندلی چوبی بسازید&quot;,
        &quot;item_condition&quot;: &quot;used&quot;,
        &quot;images_json&quot;: [
            &quot;http://localhost:3000/items/e6cb403e98a7f28b2c59e46f53a3a83d.jpg&quot;
        ],
        &quot;created_at&quot;: &quot;2026-01-06T13:58:33.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-04T13:58:36.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;category&quot;: {
            &quot;id&quot;: 2,
            &quot;parent_id&quot;: null,
            &quot;title&quot;: &quot;ابزار&quot;,
            &quot;description&quot;: &quot;ابزارهای مختلف&quot;,
            &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-06T08:52:05.000000Z&quot;
        },
        &quot;listings&quot;: [
            {
                &quot;id&quot;: 26,
                &quot;item_id&quot;: 25,
                &quot;title&quot;: &quot;ابزار نجاری&quot;,
                &quot;description&quot;: &quot;یک صندلی چوبی بسازید&quot;,
                &quot;daily_fee&quot;: &quot;41964.00&quot;,
                &quot;deposit_amount&quot;: &quot;636689.00&quot;,
                &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
                &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;view_count&quot;: 12,
                &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T12:14:25.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        ]
    }
]</code>
 </pre>
    </span>
<span id="execution-results-GETapi-public-items" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-public-items"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-public-items"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-public-items" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-public-items">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-public-items" data-method="GET"
      data-path="api/public/items"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-public-items', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-public-items"
                    onclick="tryItOut('GETapi-public-items');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-public-items"
                    onclick="cancelTryOut('GETapi-public-items');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-public-items"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/public/items</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-public-items"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-public-items"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="general-GETapi-public-listings">Display all active listings for public/guest users (homepage).</h2>

<p>
</p>



<span id="example-requests-GETapi-public-listings">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/public/listings" \
    --header "Accept: application/json" \
    --header "Content-Type: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/public/listings"
);

const headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-public-listings">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://localhost:3000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">[
    {
        &quot;id&quot;: 3,
        &quot;item_id&quot;: 3,
        &quot;title&quot;: &quot;اجاره لپ&zwnj;تاپ Dell&quot;,
        &quot;description&quot;: &quot;لپ&zwnj;تاپ با پردازنده قدرتمند&quot;,
        &quot;daily_fee&quot;: &quot;100000.00&quot;,
        &quot;deposit_amount&quot;: &quot;2000000.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-05T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-03-05T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 86,
        &quot;created_at&quot;: &quot;2026-01-05T06:50:33.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-05T10:37:46.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;item&quot;: {
            &quot;id&quot;: 3,
            &quot;owner_id&quot;: 3,
            &quot;category_id&quot;: 4,
            &quot;title&quot;: &quot;لپ&zwnj;تاپ Dell&quot;,
            &quot;description&quot;: &quot;لپ&zwnj;تاپ Dell با پردازنده Intel Core i7&quot;,
            &quot;item_condition&quot;: &quot;like_new&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/df5aa535e7670dd8789ca9b1d9135fe0.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 4,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;الکترونیکی&quot;,
                &quot;description&quot;: &quot;وسایل الکترونیکی&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 3,
                &quot;full_name&quot;: &quot;محمد کریمی&quot;,
                &quot;username&quot;: &quot;mohammad_karimi&quot;,
                &quot;email&quot;: &quot;mohammad@example.com&quot;,
                &quot;phone&quot;: &quot;09123456791&quot;,
                &quot;profile_image&quot;: null,
                &quot;trust_score&quot;: 4.2,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;شیراز، خیابان زند&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T16:19:24.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 4,
        &quot;item_id&quot;: 4,
        &quot;title&quot;: &quot;اجاره دوچرخه کوهستان&quot;,
        &quot;description&quot;: &quot;دوچرخه مناسب برای کوهنوردی&quot;,
        &quot;daily_fee&quot;: &quot;50000.00&quot;,
        &quot;deposit_amount&quot;: &quot;500000.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-05T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-05-05T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 58,
        &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-05T07:17:54.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;item&quot;: {
            &quot;id&quot;: 4,
            &quot;owner_id&quot;: 4,
            &quot;category_id&quot;: 6,
            &quot;title&quot;: &quot;دوچرخه کوهستان&quot;,
            &quot;description&quot;: &quot;دوچرخه کوهستان با کیفیت عالی&quot;,
            &quot;item_condition&quot;: &quot;used&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/bc2bb19f872f60496b11c3bac04fd520.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 6,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;ورزشی&quot;,
                &quot;description&quot;: &quot;وسایل ورزشی&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 4,
                &quot;full_name&quot;: &quot;زهرا نوری&quot;,
                &quot;username&quot;: &quot;zahra_noori&quot;,
                &quot;email&quot;: &quot;zahra@example.com&quot;,
                &quot;phone&quot;: &quot;09123456792&quot;,
                &quot;profile_image&quot;: null,
                &quot;trust_score&quot;: 4.7,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;مشهد، خیابان امام رضا&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 5,
        &quot;item_id&quot;: 5,
        &quot;title&quot;: &quot;اجاره جارو برقی&quot;,
        &quot;description&quot;: &quot;جارو برقی قدرتمند&quot;,
        &quot;daily_fee&quot;: &quot;20000.00&quot;,
        &quot;deposit_amount&quot;: &quot;300000.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-05T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-06-05T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 35,
        &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-06T12:42:40.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;item&quot;: {
            &quot;id&quot;: 5,
            &quot;owner_id&quot;: 1,
            &quot;category_id&quot;: 3,
            &quot;title&quot;: &quot;جارو برقی&quot;,
            &quot;description&quot;: &quot;جارو برقی قدرتمند&quot;,
            &quot;item_condition&quot;: &quot;like_new&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/b899ad0b235bc522afea8ff39c81790f.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 3,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;لوازم خانگی&quot;,
                &quot;description&quot;: &quot;لوازم خانگی&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 1,
                &quot;full_name&quot;: &quot;علی احمدی راد&quot;,
                &quot;username&quot;: &quot;ali_ahmadi&quot;,
                &quot;email&quot;: &quot;ali@example.com&quot;,
                &quot;phone&quot;: &quot;09123456789&quot;,
                &quot;profile_image&quot;: &quot;[\&quot;http://localhost:3000/items/da54db5b62ebf9c1a9b1a1b3bb3a605e.jpg\&quot;]&quot;,
                &quot;trust_score&quot;: 4.5,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;تهران، خیابان ولیعصر&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T16:12:13.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 6,
        &quot;item_id&quot;: 6,
        &quot;title&quot;: &quot;اجاره پازل 1000 تکه&quot;,
        &quot;description&quot;: &quot;پازل زیبا و سرگرم&zwnj;کننده&quot;,
        &quot;daily_fee&quot;: &quot;10000.00&quot;,
        &quot;deposit_amount&quot;: &quot;100000.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-05T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-07-05T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 27,
        &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-06T11:57:17.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;item&quot;: {
            &quot;id&quot;: 6,
            &quot;owner_id&quot;: 2,
            &quot;category_id&quot;: 5,
            &quot;title&quot;: &quot;پازل 1000 تکه&quot;,
            &quot;description&quot;: &quot;پازل زیبا با تصویر طبیعت&quot;,
            &quot;item_condition&quot;: &quot;new&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/6e6afbf4e39d88e8f1d377de945c82fa.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 5,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;اسباب بازی&quot;,
                &quot;description&quot;: &quot;اسباب بازی&zwnj;ها&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 2,
                &quot;full_name&quot;: &quot;مریم رضایی&quot;,
                &quot;username&quot;: &quot;maryam_rezaei&quot;,
                &quot;email&quot;: &quot;maryam@example.com&quot;,
                &quot;phone&quot;: &quot;09123456790&quot;,
                &quot;profile_image&quot;: null,
                &quot;trust_score&quot;: 4.8,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;اصفهان، خیابان چهارباغ&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T16:28:11.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 24,
        &quot;item_id&quot;: 23,
        &quot;title&quot;: &quot;دست&zwnj;های قوی&quot;,
        &quot;description&quot;: &quot;برای اوقات بیکاری  شما&quot;,
        &quot;daily_fee&quot;: &quot;27996.00&quot;,
        &quot;deposit_amount&quot;: &quot;283772.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 20,
        &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-06T12:30:18.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;item&quot;: {
            &quot;id&quot;: 23,
            &quot;owner_id&quot;: 1,
            &quot;category_id&quot;: 6,
            &quot;title&quot;: &quot;دست&zwnj;های قوی&quot;,
            &quot;description&quot;: &quot;برای اوقات بیکاری  شما&quot;,
            &quot;item_condition&quot;: &quot;new&quot;,
            &quot;images_json&quot;: &quot;[\&quot;http://localhost:3000/items/e05812eb7d02bcbf8cafd0cfee380da0.jpg\&quot;]&quot;,
            &quot;created_at&quot;: &quot;2026-01-06T13:58:20.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-06T11:12:16.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 6,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;ورزشی&quot;,
                &quot;description&quot;: &quot;وسایل ورزشی&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 1,
                &quot;full_name&quot;: &quot;علی احمدی راد&quot;,
                &quot;username&quot;: &quot;ali_ahmadi&quot;,
                &quot;email&quot;: &quot;ali@example.com&quot;,
                &quot;phone&quot;: &quot;09123456789&quot;,
                &quot;profile_image&quot;: &quot;[\&quot;http://localhost:3000/items/da54db5b62ebf9c1a9b1a1b3bb3a605e.jpg\&quot;]&quot;,
                &quot;trust_score&quot;: 4.5,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;تهران، خیابان ولیعصر&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T16:12:13.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 25,
        &quot;item_id&quot;: 24,
        &quot;title&quot;: &quot;آچار&quot;,
        &quot;description&quot;: &quot;برای تعمیرات خانگی&quot;,
        &quot;daily_fee&quot;: &quot;19783.00&quot;,
        &quot;deposit_amount&quot;: &quot;193278.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 18,
        &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-06T12:36:48.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;item&quot;: {
            &quot;id&quot;: 24,
            &quot;owner_id&quot;: 3,
            &quot;category_id&quot;: 2,
            &quot;title&quot;: &quot;آچار&quot;,
            &quot;description&quot;: &quot;برای تعمیرات خانگی&quot;,
            &quot;item_condition&quot;: &quot;used&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/ee501960fefe13840a013f3c18589c77.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-07T13:58:26.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T13:58:29.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 2,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;ابزار&quot;,
                &quot;description&quot;: &quot;ابزارهای مختلف&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T08:52:05.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 3,
                &quot;full_name&quot;: &quot;محمد کریمی&quot;,
                &quot;username&quot;: &quot;mohammad_karimi&quot;,
                &quot;email&quot;: &quot;mohammad@example.com&quot;,
                &quot;phone&quot;: &quot;09123456791&quot;,
                &quot;profile_image&quot;: null,
                &quot;trust_score&quot;: 4.2,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;شیراز، خیابان زند&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T16:19:24.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 26,
        &quot;item_id&quot;: 25,
        &quot;title&quot;: &quot;ابزار نجاری&quot;,
        &quot;description&quot;: &quot;یک صندلی چوبی بسازید&quot;,
        &quot;daily_fee&quot;: &quot;41964.00&quot;,
        &quot;deposit_amount&quot;: &quot;636689.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 12,
        &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-06T12:14:25.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;item&quot;: {
            &quot;id&quot;: 25,
            &quot;owner_id&quot;: 2,
            &quot;category_id&quot;: 2,
            &quot;title&quot;: &quot;ابزار نجاری&quot;,
            &quot;description&quot;: &quot;یک صندلی چوبی بسازید&quot;,
            &quot;item_condition&quot;: &quot;used&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/e6cb403e98a7f28b2c59e46f53a3a83d.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-06T13:58:33.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-04T13:58:36.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 2,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;ابزار&quot;,
                &quot;description&quot;: &quot;ابزارهای مختلف&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T08:52:05.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 2,
                &quot;full_name&quot;: &quot;مریم رضایی&quot;,
                &quot;username&quot;: &quot;maryam_rezaei&quot;,
                &quot;email&quot;: &quot;maryam@example.com&quot;,
                &quot;phone&quot;: &quot;09123456790&quot;,
                &quot;profile_image&quot;: null,
                &quot;trust_score&quot;: 4.8,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;اصفهان، خیابان چهارباغ&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T16:28:11.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 11,
        &quot;item_id&quot;: 10,
        &quot;title&quot;: &quot;جورچین کودکان&quot;,
        &quot;description&quot;: &quot;یک قلعه هزار رنگ بسازید و آخر هفته خود را شیرین&zwnj;تر کنید&quot;,
        &quot;daily_fee&quot;: &quot;12267.00&quot;,
        &quot;deposit_amount&quot;: &quot;165970.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 10,
        &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-06T17:14:58.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;item&quot;: {
            &quot;id&quot;: 10,
            &quot;owner_id&quot;: 2,
            &quot;category_id&quot;: 5,
            &quot;title&quot;: &quot;جورچین کودکان&quot;,
            &quot;description&quot;: &quot;یک قلعه هزار رنگ بسازید و آخر هفته خود را شیرین&zwnj;تر کنید&quot;,
            &quot;item_condition&quot;: &quot;used&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/2ad2e0775fe81e8fe6a4ccefc6636ee2.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-05T13:56:57.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T13:57:00.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 5,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;اسباب بازی&quot;,
                &quot;description&quot;: &quot;اسباب بازی&zwnj;ها&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 2,
                &quot;full_name&quot;: &quot;مریم رضایی&quot;,
                &quot;username&quot;: &quot;maryam_rezaei&quot;,
                &quot;email&quot;: &quot;maryam@example.com&quot;,
                &quot;phone&quot;: &quot;09123456790&quot;,
                &quot;profile_image&quot;: null,
                &quot;trust_score&quot;: 4.8,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;اصفهان، خیابان چهارباغ&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T16:28:11.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 22,
        &quot;item_id&quot;: 21,
        &quot;title&quot;: &quot;سیمون دوبووار&quot;,
        &quot;description&quot;: &quot;اگر به ادبیات سیاسی علاقه مندید این کتاب مناسب شماست&quot;,
        &quot;daily_fee&quot;: &quot;4032.00&quot;,
        &quot;deposit_amount&quot;: &quot;192781.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 6,
        &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-06T12:39:24.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;item&quot;: {
            &quot;id&quot;: 21,
            &quot;owner_id&quot;: 3,
            &quot;category_id&quot;: 1,
            &quot;title&quot;: &quot;سیمون دوبووار&quot;,
            &quot;description&quot;: &quot;اگر به ادبیات سیاسی علاقه مندید این کتاب مناسب شماست&quot;,
            &quot;item_condition&quot;: &quot;new&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/b5ede21269b3c45015526682602dc1eb.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-02T13:58:02.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-06T13:58:07.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 1,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;کتاب&quot;,
                &quot;description&quot;: &quot;کتاب&zwnj;های مختلف&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 3,
                &quot;full_name&quot;: &quot;محمد کریمی&quot;,
                &quot;username&quot;: &quot;mohammad_karimi&quot;,
                &quot;email&quot;: &quot;mohammad@example.com&quot;,
                &quot;phone&quot;: &quot;09123456791&quot;,
                &quot;profile_image&quot;: null,
                &quot;trust_score&quot;: 4.2,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;شیراز، خیابان زند&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T16:19:24.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 20,
        &quot;item_id&quot;: 19,
        &quot;title&quot;: &quot;هملت&quot;,
        &quot;description&quot;: &quot;نمایشنامه&zwnj;ای از اعماق تاریخ و هنر&quot;,
        &quot;daily_fee&quot;: &quot;7466.00&quot;,
        &quot;deposit_amount&quot;: &quot;199262.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 5,
        &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-06T12:42:45.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;item&quot;: {
            &quot;id&quot;: 19,
            &quot;owner_id&quot;: 2,
            &quot;category_id&quot;: 1,
            &quot;title&quot;: &quot;هملت&quot;,
            &quot;description&quot;: &quot;نمایشنامه&zwnj;ای از اعماق تاریخ و هنر&quot;,
            &quot;item_condition&quot;: &quot;old&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/1994376031428450fa5c2ac09eb4149c.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-05T13:57:51.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-06T13:57:54.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 1,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;کتاب&quot;,
                &quot;description&quot;: &quot;کتاب&zwnj;های مختلف&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 2,
                &quot;full_name&quot;: &quot;مریم رضایی&quot;,
                &quot;username&quot;: &quot;maryam_rezaei&quot;,
                &quot;email&quot;: &quot;maryam@example.com&quot;,
                &quot;phone&quot;: &quot;09123456790&quot;,
                &quot;profile_image&quot;: null,
                &quot;trust_score&quot;: 4.8,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;اصفهان، خیابان چهارباغ&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T16:28:11.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 12,
        &quot;item_id&quot;: 11,
        &quot;title&quot;: &quot;بدنسازی در خانه&quot;,
        &quot;description&quot;: &quot;برای ورک اوت در گاراژ خانه شما&quot;,
        &quot;daily_fee&quot;: &quot;29384.00&quot;,
        &quot;deposit_amount&quot;: &quot;171267.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 4,
        &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-06T12:38:48.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;item&quot;: {
            &quot;id&quot;: 11,
            &quot;owner_id&quot;: 2,
            &quot;category_id&quot;: 6,
            &quot;title&quot;: &quot;بدنسازی در خانه&quot;,
            &quot;description&quot;: &quot;برای ورک اوت در گاراژ خانه شما&quot;,
            &quot;item_condition&quot;: &quot;old&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/4d7fad73122f9185ce985bff268529c3.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-05T13:57:04.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T13:57:07.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 6,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;ورزشی&quot;,
                &quot;description&quot;: &quot;وسایل ورزشی&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 2,
                &quot;full_name&quot;: &quot;مریم رضایی&quot;,
                &quot;username&quot;: &quot;maryam_rezaei&quot;,
                &quot;email&quot;: &quot;maryam@example.com&quot;,
                &quot;phone&quot;: &quot;09123456790&quot;,
                &quot;profile_image&quot;: null,
                &quot;trust_score&quot;: 4.8,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;اصفهان، خیابان چهارباغ&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T16:28:11.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 13,
        &quot;item_id&quot;: 12,
        &quot;title&quot;: &quot;ابزار محاسبات&quot;,
        &quot;description&quot;: &quot;به عنوان یک کابینت&zwnj;ساز به دردتان می&zwnj;خورد&quot;,
        &quot;daily_fee&quot;: &quot;37482.00&quot;,
        &quot;deposit_amount&quot;: &quot;720663.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 4,
        &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-05T10:33:30.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;item&quot;: {
            &quot;id&quot;: 12,
            &quot;owner_id&quot;: 4,
            &quot;category_id&quot;: 2,
            &quot;title&quot;: &quot;ابزار محاسبات&quot;,
            &quot;description&quot;: &quot;به عنوان یک کابینت&zwnj;ساز به دردتان می&zwnj;خورد&quot;,
            &quot;item_condition&quot;: &quot;used&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/63a85aa0fde2237860b17411c6d4c057.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-05T13:57:10.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T13:57:13.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 2,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;ابزار&quot;,
                &quot;description&quot;: &quot;ابزارهای مختلف&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T08:52:05.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 4,
                &quot;full_name&quot;: &quot;زهرا نوری&quot;,
                &quot;username&quot;: &quot;zahra_noori&quot;,
                &quot;email&quot;: &quot;zahra@example.com&quot;,
                &quot;phone&quot;: &quot;09123456792&quot;,
                &quot;profile_image&quot;: null,
                &quot;trust_score&quot;: 4.7,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;مشهد، خیابان امام رضا&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 19,
        &quot;item_id&quot;: 18,
        &quot;title&quot;: &quot;ایروبیک در خانه&quot;,
        &quot;description&quot;: &quot;کلاس های آنلاین ورزش رات ثبت نام کرده و همیشه در خانه فیت بمانید&quot;,
        &quot;daily_fee&quot;: &quot;20369.00&quot;,
        &quot;deposit_amount&quot;: &quot;497940.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 4,
        &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-06T12:01:44.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;item&quot;: {
            &quot;id&quot;: 18,
            &quot;owner_id&quot;: 4,
            &quot;category_id&quot;: 6,
            &quot;title&quot;: &quot;ایروبیک در خانه&quot;,
            &quot;description&quot;: &quot;کلاس های آنلاین ورزش رات ثبت نام کرده و همیشه در خانه فیت بمانید&quot;,
            &quot;item_condition&quot;: &quot;new&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/881611da63292e272aa6564a237e5e08.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-05T13:57:44.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T13:57:48.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 6,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;ورزشی&quot;,
                &quot;description&quot;: &quot;وسایل ورزشی&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 4,
                &quot;full_name&quot;: &quot;زهرا نوری&quot;,
                &quot;username&quot;: &quot;zahra_noori&quot;,
                &quot;email&quot;: &quot;zahra@example.com&quot;,
                &quot;phone&quot;: &quot;09123456792&quot;,
                &quot;profile_image&quot;: null,
                &quot;trust_score&quot;: 4.7,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;مشهد، خیابان امام رضا&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 9,
        &quot;item_id&quot;: 8,
        &quot;title&quot;: &quot;عروسک ببعی&quot;,
        &quot;description&quot;: &quot;دوست مهربان و نرم کودکان&quot;,
        &quot;daily_fee&quot;: &quot;6714.00&quot;,
        &quot;deposit_amount&quot;: &quot;123502.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 2,
        &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-05T11:33:47.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;item&quot;: {
            &quot;id&quot;: 8,
            &quot;owner_id&quot;: 4,
            &quot;category_id&quot;: 5,
            &quot;title&quot;: &quot;عروسک ببعی&quot;,
            &quot;description&quot;: &quot;دوست مهربان و نرم کودکان&quot;,
            &quot;item_condition&quot;: &quot;new&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/0c16e7cbc7d74492d92dc71a97634258.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-06T13:56:44.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-06T13:56:47.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 5,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;اسباب بازی&quot;,
                &quot;description&quot;: &quot;اسباب بازی&zwnj;ها&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 4,
                &quot;full_name&quot;: &quot;زهرا نوری&quot;,
                &quot;username&quot;: &quot;zahra_noori&quot;,
                &quot;email&quot;: &quot;zahra@example.com&quot;,
                &quot;phone&quot;: &quot;09123456792&quot;,
                &quot;profile_image&quot;: null,
                &quot;trust_score&quot;: 4.7,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;مشهد، خیابان امام رضا&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 15,
        &quot;item_id&quot;: 14,
        &quot;title&quot;: &quot;موجودات ریز و بانمک&quot;,
        &quot;description&quot;: &quot;بچه&zwnj;های خود را به دنیایی از عجایت رنگارنگ بیاورید و اینطور داستان بگویید&quot;,
        &quot;daily_fee&quot;: &quot;9647.00&quot;,
        &quot;deposit_amount&quot;: &quot;149999.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 2,
        &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-06T11:21:43.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;item&quot;: {
            &quot;id&quot;: 14,
            &quot;owner_id&quot;: 4,
            &quot;category_id&quot;: 5,
            &quot;title&quot;: &quot;موجودات ریز و بانمک&quot;,
            &quot;description&quot;: &quot;بچه&zwnj;های خود را به دنیایی از عجایت رنگارنگ بیاورید و اینطور داستان بگویید&quot;,
            &quot;item_condition&quot;: &quot;like_new&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/546e1a781d354475da98753ca33984ab.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-05T13:57:23.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T13:57:27.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 5,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;اسباب بازی&quot;,
                &quot;description&quot;: &quot;اسباب بازی&zwnj;ها&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 4,
                &quot;full_name&quot;: &quot;زهرا نوری&quot;,
                &quot;username&quot;: &quot;zahra_noori&quot;,
                &quot;email&quot;: &quot;zahra@example.com&quot;,
                &quot;phone&quot;: &quot;09123456792&quot;,
                &quot;profile_image&quot;: null,
                &quot;trust_score&quot;: 4.7,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;مشهد، خیابان امام رضا&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 16,
        &quot;item_id&quot;: 15,
        &quot;title&quot;: &quot;کتابی خیال&zwnj;انگیز&quot;,
        &quot;description&quot;: &quot;برای خانم&zwnj;هایی که زیاد اورتینک می&zwnj;کنند.&quot;,
        &quot;daily_fee&quot;: &quot;7280.00&quot;,
        &quot;deposit_amount&quot;: &quot;61188.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 2,
        &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-06T11:31:35.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;item&quot;: {
            &quot;id&quot;: 15,
            &quot;owner_id&quot;: 1,
            &quot;category_id&quot;: 1,
            &quot;title&quot;: &quot;کتابی خیال&zwnj;انگیز&quot;,
            &quot;description&quot;: &quot;برای خانم&zwnj;هایی که زیاد اورتینک می&zwnj;کنند.&quot;,
            &quot;item_condition&quot;: &quot;used&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/42151b6bb9ae2be8e2e08864a0bfacc1.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-05T13:57:31.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T13:57:34.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 1,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;کتاب&quot;,
                &quot;description&quot;: &quot;کتاب&zwnj;های مختلف&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 1,
                &quot;full_name&quot;: &quot;علی احمدی راد&quot;,
                &quot;username&quot;: &quot;ali_ahmadi&quot;,
                &quot;email&quot;: &quot;ali@example.com&quot;,
                &quot;phone&quot;: &quot;09123456789&quot;,
                &quot;profile_image&quot;: &quot;[\&quot;http://localhost:3000/items/da54db5b62ebf9c1a9b1a1b3bb3a605e.jpg\&quot;]&quot;,
                &quot;trust_score&quot;: 4.5,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;تهران، خیابان ولیعصر&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T16:12:13.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 21,
        &quot;item_id&quot;: 20,
        &quot;title&quot;: &quot;اسکیت&zwnj;بورد نوستالژی&quot;,
        &quot;description&quot;: &quot;مدتیه که گوشه اتاق مونده و اگه لازمش دارید بهتون قرض میدم&quot;,
        &quot;daily_fee&quot;: &quot;36047.00&quot;,
        &quot;deposit_amount&quot;: &quot;404534.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 2,
        &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-05T11:29:11.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;item&quot;: {
            &quot;id&quot;: 20,
            &quot;owner_id&quot;: 1,
            &quot;category_id&quot;: 6,
            &quot;title&quot;: &quot;اسکیت&zwnj;بورد نوستالژی&quot;,
            &quot;description&quot;: &quot;مدتیه که گوشه اتاق مونده و اگه لازمش دارید بهتون قرض میدم&quot;,
            &quot;item_condition&quot;: &quot;old&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/a22eda8cc9e2e7629fdeed8a2180183b.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-04T13:57:57.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T13:58:00.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 6,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;ورزشی&quot;,
                &quot;description&quot;: &quot;وسایل ورزشی&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 1,
                &quot;full_name&quot;: &quot;علی احمدی راد&quot;,
                &quot;username&quot;: &quot;ali_ahmadi&quot;,
                &quot;email&quot;: &quot;ali@example.com&quot;,
                &quot;phone&quot;: &quot;09123456789&quot;,
                &quot;profile_image&quot;: &quot;[\&quot;http://localhost:3000/items/da54db5b62ebf9c1a9b1a1b3bb3a605e.jpg\&quot;]&quot;,
                &quot;trust_score&quot;: 4.5,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;تهران، خیابان ولیعصر&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T16:12:13.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 23,
        &quot;item_id&quot;: 22,
        &quot;title&quot;: &quot;امیلی برانت&quot;,
        &quot;description&quot;: &quot;داستانی پر ابهام و خیال انگیز&quot;,
        &quot;daily_fee&quot;: &quot;6502.00&quot;,
        &quot;deposit_amount&quot;: &quot;122042.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 1,
        &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-06T11:43:44.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;item&quot;: {
            &quot;id&quot;: 22,
            &quot;owner_id&quot;: 4,
            &quot;category_id&quot;: 1,
            &quot;title&quot;: &quot;امیلی برانت&quot;,
            &quot;description&quot;: &quot;داستانی پر ابهام و خیال انگیز&quot;,
            &quot;item_condition&quot;: &quot;like_new&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/ce68c376ee804404db4d0c82bc242706.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-01T13:58:10.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T13:58:17.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 1,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;کتاب&quot;,
                &quot;description&quot;: &quot;کتاب&zwnj;های مختلف&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 4,
                &quot;full_name&quot;: &quot;زهرا نوری&quot;,
                &quot;username&quot;: &quot;zahra_noori&quot;,
                &quot;email&quot;: &quot;zahra@example.com&quot;,
                &quot;phone&quot;: &quot;09123456792&quot;,
                &quot;profile_image&quot;: null,
                &quot;trust_score&quot;: 4.7,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;مشهد، خیابان امام رضا&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 8,
        &quot;item_id&quot;: 7,
        &quot;title&quot;: &quot;ابزار جنگلی&quot;,
        &quot;description&quot;: &quot;برای یک گردش امن و باصفا در جنگل&quot;,
        &quot;daily_fee&quot;: &quot;44808.00&quot;,
        &quot;deposit_amount&quot;: &quot;431398.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 0,
        &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;item&quot;: {
            &quot;id&quot;: 7,
            &quot;owner_id&quot;: 3,
            &quot;category_id&quot;: 2,
            &quot;title&quot;: &quot;ابزار جنگلی&quot;,
            &quot;description&quot;: &quot;برای یک گردش امن و باصفا در جنگل&quot;,
            &quot;item_condition&quot;: &quot;used&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/89fb9d307d6332a1c533d2dfa23ce554.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-05T13:56:31.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T13:56:39.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 2,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;ابزار&quot;,
                &quot;description&quot;: &quot;ابزارهای مختلف&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T08:52:05.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 3,
                &quot;full_name&quot;: &quot;محمد کریمی&quot;,
                &quot;username&quot;: &quot;mohammad_karimi&quot;,
                &quot;email&quot;: &quot;mohammad@example.com&quot;,
                &quot;phone&quot;: &quot;09123456791&quot;,
                &quot;profile_image&quot;: null,
                &quot;trust_score&quot;: 4.2,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;شیراز، خیابان زند&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T16:19:24.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 14,
        &quot;item_id&quot;: 13,
        &quot;title&quot;: &quot;فیل چوبی&quot;,
        &quot;description&quot;: &quot;اسباب بازی دستساز و بی&zwnj;نهایت زیبای فیلی&quot;,
        &quot;daily_fee&quot;: &quot;13859.00&quot;,
        &quot;deposit_amount&quot;: &quot;104893.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 0,
        &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;item&quot;: {
            &quot;id&quot;: 13,
            &quot;owner_id&quot;: 3,
            &quot;category_id&quot;: 5,
            &quot;title&quot;: &quot;فیل چوبی&quot;,
            &quot;description&quot;: &quot;اسباب بازی دستساز و بی&zwnj;نهایت زیبای فیلی&quot;,
            &quot;item_condition&quot;: &quot;like_new&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/95eb311980d9d95e7ae52f0a737e775b.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-05T13:57:16.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T13:57:20.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 5,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;اسباب بازی&quot;,
                &quot;description&quot;: &quot;اسباب بازی&zwnj;ها&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 3,
                &quot;full_name&quot;: &quot;محمد کریمی&quot;,
                &quot;username&quot;: &quot;mohammad_karimi&quot;,
                &quot;email&quot;: &quot;mohammad@example.com&quot;,
                &quot;phone&quot;: &quot;09123456791&quot;,
                &quot;profile_image&quot;: null,
                &quot;trust_score&quot;: 4.2,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;شیراز، خیابان زند&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T16:19:24.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 17,
        &quot;item_id&quot;: 16,
        &quot;title&quot;: &quot;مکعب روبیک&quot;,
        &quot;description&quot;: &quot;اگر نوجوانتان باهوش هست این مناسب شماست&quot;,
        &quot;daily_fee&quot;: &quot;5806.00&quot;,
        &quot;deposit_amount&quot;: &quot;262822.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 0,
        &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;item&quot;: {
            &quot;id&quot;: 16,
            &quot;owner_id&quot;: 2,
            &quot;category_id&quot;: 5,
            &quot;title&quot;: &quot;مکعب روبیک&quot;,
            &quot;description&quot;: &quot;اگر نوجوانتان باهوش هست این مناسب شماست&quot;,
            &quot;item_condition&quot;: &quot;new&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/78371c77f1a3d7f9ded200c18242ae4e.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-05T13:57:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T13:57:41.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 5,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;اسباب بازی&quot;,
                &quot;description&quot;: &quot;اسباب بازی&zwnj;ها&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 2,
                &quot;full_name&quot;: &quot;مریم رضایی&quot;,
                &quot;username&quot;: &quot;maryam_rezaei&quot;,
                &quot;email&quot;: &quot;maryam@example.com&quot;,
                &quot;phone&quot;: &quot;09123456790&quot;,
                &quot;profile_image&quot;: null,
                &quot;trust_score&quot;: 4.8,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;اصفهان، خیابان چهارباغ&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T16:28:11.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 18,
        &quot;item_id&quot;: 17,
        &quot;title&quot;: &quot;اسکیت&zwnj;بورد گروهی&quot;,
        &quot;description&quot;: &quot;با اکیپ دوستانتان این ورزش جادویی را تجربه کنید&quot;,
        &quot;daily_fee&quot;: &quot;36573.00&quot;,
        &quot;deposit_amount&quot;: &quot;440176.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 0,
        &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;item&quot;: {
            &quot;id&quot;: 17,
            &quot;owner_id&quot;: 3,
            &quot;category_id&quot;: 6,
            &quot;title&quot;: &quot;اسکیت&zwnj;بورد گروهی&quot;,
            &quot;description&quot;: &quot;با اکیپ دوستانتان این ورزش جادویی را تجربه کنید&quot;,
            &quot;item_condition&quot;: &quot;used&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/293212be4ddd17d68acbfaac78d56586.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-06T14:23:19.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-06T14:23:24.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 6,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;ورزشی&quot;,
                &quot;description&quot;: &quot;وسایل ورزشی&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 3,
                &quot;full_name&quot;: &quot;محمد کریمی&quot;,
                &quot;username&quot;: &quot;mohammad_karimi&quot;,
                &quot;email&quot;: &quot;mohammad@example.com&quot;,
                &quot;phone&quot;: &quot;09123456791&quot;,
                &quot;profile_image&quot;: null,
                &quot;trust_score&quot;: 4.2,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;شیراز، خیابان زند&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T16:19:24.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    }
]</code>
 </pre>
    </span>
<span id="execution-results-GETapi-public-listings" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-public-listings"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-public-listings"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-public-listings" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-public-listings">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-public-listings" data-method="GET"
      data-path="api/public/listings"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-public-listings', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-public-listings"
                    onclick="tryItOut('GETapi-public-listings');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-public-listings"
                    onclick="cancelTryOut('GETapi-public-listings');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-public-listings"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/public/listings</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-public-listings"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-public-listings"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="general-GETapi-public-listings-newest">Get newest listings (ordered by created_at desc)</h2>

<p>
</p>



<span id="example-requests-GETapi-public-listings-newest">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/public/listings/newest" \
    --header "Accept: application/json" \
    --header "Content-Type: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/public/listings/newest"
);

const headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-public-listings-newest">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://localhost:3000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">[
    {
        &quot;id&quot;: 8,
        &quot;item_id&quot;: 7,
        &quot;title&quot;: &quot;ابزار جنگلی&quot;,
        &quot;description&quot;: &quot;برای یک گردش امن و باصفا در جنگل&quot;,
        &quot;daily_fee&quot;: &quot;44808.00&quot;,
        &quot;deposit_amount&quot;: &quot;431398.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 0,
        &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;item&quot;: {
            &quot;id&quot;: 7,
            &quot;owner_id&quot;: 3,
            &quot;category_id&quot;: 2,
            &quot;title&quot;: &quot;ابزار جنگلی&quot;,
            &quot;description&quot;: &quot;برای یک گردش امن و باصفا در جنگل&quot;,
            &quot;item_condition&quot;: &quot;used&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/89fb9d307d6332a1c533d2dfa23ce554.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-05T13:56:31.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T13:56:39.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 2,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;ابزار&quot;,
                &quot;description&quot;: &quot;ابزارهای مختلف&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T08:52:05.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 3,
                &quot;full_name&quot;: &quot;محمد کریمی&quot;,
                &quot;username&quot;: &quot;mohammad_karimi&quot;,
                &quot;email&quot;: &quot;mohammad@example.com&quot;,
                &quot;phone&quot;: &quot;09123456791&quot;,
                &quot;profile_image&quot;: null,
                &quot;trust_score&quot;: 4.2,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;شیراز، خیابان زند&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T16:19:24.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 9,
        &quot;item_id&quot;: 8,
        &quot;title&quot;: &quot;عروسک ببعی&quot;,
        &quot;description&quot;: &quot;دوست مهربان و نرم کودکان&quot;,
        &quot;daily_fee&quot;: &quot;6714.00&quot;,
        &quot;deposit_amount&quot;: &quot;123502.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 2,
        &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-05T11:33:47.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;item&quot;: {
            &quot;id&quot;: 8,
            &quot;owner_id&quot;: 4,
            &quot;category_id&quot;: 5,
            &quot;title&quot;: &quot;عروسک ببعی&quot;,
            &quot;description&quot;: &quot;دوست مهربان و نرم کودکان&quot;,
            &quot;item_condition&quot;: &quot;new&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/0c16e7cbc7d74492d92dc71a97634258.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-06T13:56:44.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-06T13:56:47.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 5,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;اسباب بازی&quot;,
                &quot;description&quot;: &quot;اسباب بازی&zwnj;ها&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 4,
                &quot;full_name&quot;: &quot;زهرا نوری&quot;,
                &quot;username&quot;: &quot;zahra_noori&quot;,
                &quot;email&quot;: &quot;zahra@example.com&quot;,
                &quot;phone&quot;: &quot;09123456792&quot;,
                &quot;profile_image&quot;: null,
                &quot;trust_score&quot;: 4.7,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;مشهد، خیابان امام رضا&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 11,
        &quot;item_id&quot;: 10,
        &quot;title&quot;: &quot;جورچین کودکان&quot;,
        &quot;description&quot;: &quot;یک قلعه هزار رنگ بسازید و آخر هفته خود را شیرین&zwnj;تر کنید&quot;,
        &quot;daily_fee&quot;: &quot;12267.00&quot;,
        &quot;deposit_amount&quot;: &quot;165970.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 10,
        &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-06T17:14:58.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;item&quot;: {
            &quot;id&quot;: 10,
            &quot;owner_id&quot;: 2,
            &quot;category_id&quot;: 5,
            &quot;title&quot;: &quot;جورچین کودکان&quot;,
            &quot;description&quot;: &quot;یک قلعه هزار رنگ بسازید و آخر هفته خود را شیرین&zwnj;تر کنید&quot;,
            &quot;item_condition&quot;: &quot;used&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/2ad2e0775fe81e8fe6a4ccefc6636ee2.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-05T13:56:57.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T13:57:00.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 5,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;اسباب بازی&quot;,
                &quot;description&quot;: &quot;اسباب بازی&zwnj;ها&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 2,
                &quot;full_name&quot;: &quot;مریم رضایی&quot;,
                &quot;username&quot;: &quot;maryam_rezaei&quot;,
                &quot;email&quot;: &quot;maryam@example.com&quot;,
                &quot;phone&quot;: &quot;09123456790&quot;,
                &quot;profile_image&quot;: null,
                &quot;trust_score&quot;: 4.8,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;اصفهان، خیابان چهارباغ&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T16:28:11.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 12,
        &quot;item_id&quot;: 11,
        &quot;title&quot;: &quot;بدنسازی در خانه&quot;,
        &quot;description&quot;: &quot;برای ورک اوت در گاراژ خانه شما&quot;,
        &quot;daily_fee&quot;: &quot;29384.00&quot;,
        &quot;deposit_amount&quot;: &quot;171267.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 4,
        &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-06T12:38:48.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;item&quot;: {
            &quot;id&quot;: 11,
            &quot;owner_id&quot;: 2,
            &quot;category_id&quot;: 6,
            &quot;title&quot;: &quot;بدنسازی در خانه&quot;,
            &quot;description&quot;: &quot;برای ورک اوت در گاراژ خانه شما&quot;,
            &quot;item_condition&quot;: &quot;old&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/4d7fad73122f9185ce985bff268529c3.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-05T13:57:04.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T13:57:07.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 6,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;ورزشی&quot;,
                &quot;description&quot;: &quot;وسایل ورزشی&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 2,
                &quot;full_name&quot;: &quot;مریم رضایی&quot;,
                &quot;username&quot;: &quot;maryam_rezaei&quot;,
                &quot;email&quot;: &quot;maryam@example.com&quot;,
                &quot;phone&quot;: &quot;09123456790&quot;,
                &quot;profile_image&quot;: null,
                &quot;trust_score&quot;: 4.8,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;اصفهان، خیابان چهارباغ&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T16:28:11.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 13,
        &quot;item_id&quot;: 12,
        &quot;title&quot;: &quot;ابزار محاسبات&quot;,
        &quot;description&quot;: &quot;به عنوان یک کابینت&zwnj;ساز به دردتان می&zwnj;خورد&quot;,
        &quot;daily_fee&quot;: &quot;37482.00&quot;,
        &quot;deposit_amount&quot;: &quot;720663.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 4,
        &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-05T10:33:30.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;item&quot;: {
            &quot;id&quot;: 12,
            &quot;owner_id&quot;: 4,
            &quot;category_id&quot;: 2,
            &quot;title&quot;: &quot;ابزار محاسبات&quot;,
            &quot;description&quot;: &quot;به عنوان یک کابینت&zwnj;ساز به دردتان می&zwnj;خورد&quot;,
            &quot;item_condition&quot;: &quot;used&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/63a85aa0fde2237860b17411c6d4c057.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-05T13:57:10.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T13:57:13.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 2,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;ابزار&quot;,
                &quot;description&quot;: &quot;ابزارهای مختلف&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T08:52:05.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 4,
                &quot;full_name&quot;: &quot;زهرا نوری&quot;,
                &quot;username&quot;: &quot;zahra_noori&quot;,
                &quot;email&quot;: &quot;zahra@example.com&quot;,
                &quot;phone&quot;: &quot;09123456792&quot;,
                &quot;profile_image&quot;: null,
                &quot;trust_score&quot;: 4.7,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;مشهد، خیابان امام رضا&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 14,
        &quot;item_id&quot;: 13,
        &quot;title&quot;: &quot;فیل چوبی&quot;,
        &quot;description&quot;: &quot;اسباب بازی دستساز و بی&zwnj;نهایت زیبای فیلی&quot;,
        &quot;daily_fee&quot;: &quot;13859.00&quot;,
        &quot;deposit_amount&quot;: &quot;104893.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 0,
        &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;item&quot;: {
            &quot;id&quot;: 13,
            &quot;owner_id&quot;: 3,
            &quot;category_id&quot;: 5,
            &quot;title&quot;: &quot;فیل چوبی&quot;,
            &quot;description&quot;: &quot;اسباب بازی دستساز و بی&zwnj;نهایت زیبای فیلی&quot;,
            &quot;item_condition&quot;: &quot;like_new&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/95eb311980d9d95e7ae52f0a737e775b.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-05T13:57:16.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T13:57:20.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 5,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;اسباب بازی&quot;,
                &quot;description&quot;: &quot;اسباب بازی&zwnj;ها&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 3,
                &quot;full_name&quot;: &quot;محمد کریمی&quot;,
                &quot;username&quot;: &quot;mohammad_karimi&quot;,
                &quot;email&quot;: &quot;mohammad@example.com&quot;,
                &quot;phone&quot;: &quot;09123456791&quot;,
                &quot;profile_image&quot;: null,
                &quot;trust_score&quot;: 4.2,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;شیراز، خیابان زند&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T16:19:24.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 15,
        &quot;item_id&quot;: 14,
        &quot;title&quot;: &quot;موجودات ریز و بانمک&quot;,
        &quot;description&quot;: &quot;بچه&zwnj;های خود را به دنیایی از عجایت رنگارنگ بیاورید و اینطور داستان بگویید&quot;,
        &quot;daily_fee&quot;: &quot;9647.00&quot;,
        &quot;deposit_amount&quot;: &quot;149999.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 2,
        &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-06T11:21:43.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;item&quot;: {
            &quot;id&quot;: 14,
            &quot;owner_id&quot;: 4,
            &quot;category_id&quot;: 5,
            &quot;title&quot;: &quot;موجودات ریز و بانمک&quot;,
            &quot;description&quot;: &quot;بچه&zwnj;های خود را به دنیایی از عجایت رنگارنگ بیاورید و اینطور داستان بگویید&quot;,
            &quot;item_condition&quot;: &quot;like_new&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/546e1a781d354475da98753ca33984ab.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-05T13:57:23.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T13:57:27.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 5,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;اسباب بازی&quot;,
                &quot;description&quot;: &quot;اسباب بازی&zwnj;ها&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 4,
                &quot;full_name&quot;: &quot;زهرا نوری&quot;,
                &quot;username&quot;: &quot;zahra_noori&quot;,
                &quot;email&quot;: &quot;zahra@example.com&quot;,
                &quot;phone&quot;: &quot;09123456792&quot;,
                &quot;profile_image&quot;: null,
                &quot;trust_score&quot;: 4.7,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;مشهد، خیابان امام رضا&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 16,
        &quot;item_id&quot;: 15,
        &quot;title&quot;: &quot;کتابی خیال&zwnj;انگیز&quot;,
        &quot;description&quot;: &quot;برای خانم&zwnj;هایی که زیاد اورتینک می&zwnj;کنند.&quot;,
        &quot;daily_fee&quot;: &quot;7280.00&quot;,
        &quot;deposit_amount&quot;: &quot;61188.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 2,
        &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-06T11:31:35.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;item&quot;: {
            &quot;id&quot;: 15,
            &quot;owner_id&quot;: 1,
            &quot;category_id&quot;: 1,
            &quot;title&quot;: &quot;کتابی خیال&zwnj;انگیز&quot;,
            &quot;description&quot;: &quot;برای خانم&zwnj;هایی که زیاد اورتینک می&zwnj;کنند.&quot;,
            &quot;item_condition&quot;: &quot;used&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/42151b6bb9ae2be8e2e08864a0bfacc1.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-05T13:57:31.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T13:57:34.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 1,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;کتاب&quot;,
                &quot;description&quot;: &quot;کتاب&zwnj;های مختلف&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 1,
                &quot;full_name&quot;: &quot;علی احمدی راد&quot;,
                &quot;username&quot;: &quot;ali_ahmadi&quot;,
                &quot;email&quot;: &quot;ali@example.com&quot;,
                &quot;phone&quot;: &quot;09123456789&quot;,
                &quot;profile_image&quot;: &quot;[\&quot;http://localhost:3000/items/da54db5b62ebf9c1a9b1a1b3bb3a605e.jpg\&quot;]&quot;,
                &quot;trust_score&quot;: 4.5,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;تهران، خیابان ولیعصر&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T16:12:13.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 17,
        &quot;item_id&quot;: 16,
        &quot;title&quot;: &quot;مکعب روبیک&quot;,
        &quot;description&quot;: &quot;اگر نوجوانتان باهوش هست این مناسب شماست&quot;,
        &quot;daily_fee&quot;: &quot;5806.00&quot;,
        &quot;deposit_amount&quot;: &quot;262822.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 0,
        &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;item&quot;: {
            &quot;id&quot;: 16,
            &quot;owner_id&quot;: 2,
            &quot;category_id&quot;: 5,
            &quot;title&quot;: &quot;مکعب روبیک&quot;,
            &quot;description&quot;: &quot;اگر نوجوانتان باهوش هست این مناسب شماست&quot;,
            &quot;item_condition&quot;: &quot;new&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/78371c77f1a3d7f9ded200c18242ae4e.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-05T13:57:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T13:57:41.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 5,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;اسباب بازی&quot;,
                &quot;description&quot;: &quot;اسباب بازی&zwnj;ها&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 2,
                &quot;full_name&quot;: &quot;مریم رضایی&quot;,
                &quot;username&quot;: &quot;maryam_rezaei&quot;,
                &quot;email&quot;: &quot;maryam@example.com&quot;,
                &quot;phone&quot;: &quot;09123456790&quot;,
                &quot;profile_image&quot;: null,
                &quot;trust_score&quot;: 4.8,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;اصفهان، خیابان چهارباغ&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T16:28:11.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 18,
        &quot;item_id&quot;: 17,
        &quot;title&quot;: &quot;اسکیت&zwnj;بورد گروهی&quot;,
        &quot;description&quot;: &quot;با اکیپ دوستانتان این ورزش جادویی را تجربه کنید&quot;,
        &quot;daily_fee&quot;: &quot;36573.00&quot;,
        &quot;deposit_amount&quot;: &quot;440176.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 0,
        &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;item&quot;: {
            &quot;id&quot;: 17,
            &quot;owner_id&quot;: 3,
            &quot;category_id&quot;: 6,
            &quot;title&quot;: &quot;اسکیت&zwnj;بورد گروهی&quot;,
            &quot;description&quot;: &quot;با اکیپ دوستانتان این ورزش جادویی را تجربه کنید&quot;,
            &quot;item_condition&quot;: &quot;used&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/293212be4ddd17d68acbfaac78d56586.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-06T14:23:19.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-06T14:23:24.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 6,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;ورزشی&quot;,
                &quot;description&quot;: &quot;وسایل ورزشی&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 3,
                &quot;full_name&quot;: &quot;محمد کریمی&quot;,
                &quot;username&quot;: &quot;mohammad_karimi&quot;,
                &quot;email&quot;: &quot;mohammad@example.com&quot;,
                &quot;phone&quot;: &quot;09123456791&quot;,
                &quot;profile_image&quot;: null,
                &quot;trust_score&quot;: 4.2,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;شیراز، خیابان زند&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T16:19:24.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 19,
        &quot;item_id&quot;: 18,
        &quot;title&quot;: &quot;ایروبیک در خانه&quot;,
        &quot;description&quot;: &quot;کلاس های آنلاین ورزش رات ثبت نام کرده و همیشه در خانه فیت بمانید&quot;,
        &quot;daily_fee&quot;: &quot;20369.00&quot;,
        &quot;deposit_amount&quot;: &quot;497940.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 4,
        &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-06T12:01:44.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;item&quot;: {
            &quot;id&quot;: 18,
            &quot;owner_id&quot;: 4,
            &quot;category_id&quot;: 6,
            &quot;title&quot;: &quot;ایروبیک در خانه&quot;,
            &quot;description&quot;: &quot;کلاس های آنلاین ورزش رات ثبت نام کرده و همیشه در خانه فیت بمانید&quot;,
            &quot;item_condition&quot;: &quot;new&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/881611da63292e272aa6564a237e5e08.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-05T13:57:44.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T13:57:48.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 6,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;ورزشی&quot;,
                &quot;description&quot;: &quot;وسایل ورزشی&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 4,
                &quot;full_name&quot;: &quot;زهرا نوری&quot;,
                &quot;username&quot;: &quot;zahra_noori&quot;,
                &quot;email&quot;: &quot;zahra@example.com&quot;,
                &quot;phone&quot;: &quot;09123456792&quot;,
                &quot;profile_image&quot;: null,
                &quot;trust_score&quot;: 4.7,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;مشهد، خیابان امام رضا&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 20,
        &quot;item_id&quot;: 19,
        &quot;title&quot;: &quot;هملت&quot;,
        &quot;description&quot;: &quot;نمایشنامه&zwnj;ای از اعماق تاریخ و هنر&quot;,
        &quot;daily_fee&quot;: &quot;7466.00&quot;,
        &quot;deposit_amount&quot;: &quot;199262.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 5,
        &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-06T12:42:45.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;item&quot;: {
            &quot;id&quot;: 19,
            &quot;owner_id&quot;: 2,
            &quot;category_id&quot;: 1,
            &quot;title&quot;: &quot;هملت&quot;,
            &quot;description&quot;: &quot;نمایشنامه&zwnj;ای از اعماق تاریخ و هنر&quot;,
            &quot;item_condition&quot;: &quot;old&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/1994376031428450fa5c2ac09eb4149c.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-05T13:57:51.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-06T13:57:54.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 1,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;کتاب&quot;,
                &quot;description&quot;: &quot;کتاب&zwnj;های مختلف&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 2,
                &quot;full_name&quot;: &quot;مریم رضایی&quot;,
                &quot;username&quot;: &quot;maryam_rezaei&quot;,
                &quot;email&quot;: &quot;maryam@example.com&quot;,
                &quot;phone&quot;: &quot;09123456790&quot;,
                &quot;profile_image&quot;: null,
                &quot;trust_score&quot;: 4.8,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;اصفهان، خیابان چهارباغ&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T16:28:11.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 21,
        &quot;item_id&quot;: 20,
        &quot;title&quot;: &quot;اسکیت&zwnj;بورد نوستالژی&quot;,
        &quot;description&quot;: &quot;مدتیه که گوشه اتاق مونده و اگه لازمش دارید بهتون قرض میدم&quot;,
        &quot;daily_fee&quot;: &quot;36047.00&quot;,
        &quot;deposit_amount&quot;: &quot;404534.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 2,
        &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-05T11:29:11.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;item&quot;: {
            &quot;id&quot;: 20,
            &quot;owner_id&quot;: 1,
            &quot;category_id&quot;: 6,
            &quot;title&quot;: &quot;اسکیت&zwnj;بورد نوستالژی&quot;,
            &quot;description&quot;: &quot;مدتیه که گوشه اتاق مونده و اگه لازمش دارید بهتون قرض میدم&quot;,
            &quot;item_condition&quot;: &quot;old&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/a22eda8cc9e2e7629fdeed8a2180183b.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-04T13:57:57.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T13:58:00.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 6,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;ورزشی&quot;,
                &quot;description&quot;: &quot;وسایل ورزشی&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 1,
                &quot;full_name&quot;: &quot;علی احمدی راد&quot;,
                &quot;username&quot;: &quot;ali_ahmadi&quot;,
                &quot;email&quot;: &quot;ali@example.com&quot;,
                &quot;phone&quot;: &quot;09123456789&quot;,
                &quot;profile_image&quot;: &quot;[\&quot;http://localhost:3000/items/da54db5b62ebf9c1a9b1a1b3bb3a605e.jpg\&quot;]&quot;,
                &quot;trust_score&quot;: 4.5,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;تهران، خیابان ولیعصر&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T16:12:13.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 22,
        &quot;item_id&quot;: 21,
        &quot;title&quot;: &quot;سیمون دوبووار&quot;,
        &quot;description&quot;: &quot;اگر به ادبیات سیاسی علاقه مندید این کتاب مناسب شماست&quot;,
        &quot;daily_fee&quot;: &quot;4032.00&quot;,
        &quot;deposit_amount&quot;: &quot;192781.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 6,
        &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-06T12:39:24.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;item&quot;: {
            &quot;id&quot;: 21,
            &quot;owner_id&quot;: 3,
            &quot;category_id&quot;: 1,
            &quot;title&quot;: &quot;سیمون دوبووار&quot;,
            &quot;description&quot;: &quot;اگر به ادبیات سیاسی علاقه مندید این کتاب مناسب شماست&quot;,
            &quot;item_condition&quot;: &quot;new&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/b5ede21269b3c45015526682602dc1eb.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-02T13:58:02.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-06T13:58:07.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 1,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;کتاب&quot;,
                &quot;description&quot;: &quot;کتاب&zwnj;های مختلف&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 3,
                &quot;full_name&quot;: &quot;محمد کریمی&quot;,
                &quot;username&quot;: &quot;mohammad_karimi&quot;,
                &quot;email&quot;: &quot;mohammad@example.com&quot;,
                &quot;phone&quot;: &quot;09123456791&quot;,
                &quot;profile_image&quot;: null,
                &quot;trust_score&quot;: 4.2,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;شیراز، خیابان زند&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T16:19:24.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 23,
        &quot;item_id&quot;: 22,
        &quot;title&quot;: &quot;امیلی برانت&quot;,
        &quot;description&quot;: &quot;داستانی پر ابهام و خیال انگیز&quot;,
        &quot;daily_fee&quot;: &quot;6502.00&quot;,
        &quot;deposit_amount&quot;: &quot;122042.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 1,
        &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-06T11:43:44.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;item&quot;: {
            &quot;id&quot;: 22,
            &quot;owner_id&quot;: 4,
            &quot;category_id&quot;: 1,
            &quot;title&quot;: &quot;امیلی برانت&quot;,
            &quot;description&quot;: &quot;داستانی پر ابهام و خیال انگیز&quot;,
            &quot;item_condition&quot;: &quot;like_new&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/ce68c376ee804404db4d0c82bc242706.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-01T13:58:10.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T13:58:17.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 1,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;کتاب&quot;,
                &quot;description&quot;: &quot;کتاب&zwnj;های مختلف&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 4,
                &quot;full_name&quot;: &quot;زهرا نوری&quot;,
                &quot;username&quot;: &quot;zahra_noori&quot;,
                &quot;email&quot;: &quot;zahra@example.com&quot;,
                &quot;phone&quot;: &quot;09123456792&quot;,
                &quot;profile_image&quot;: null,
                &quot;trust_score&quot;: 4.7,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;مشهد، خیابان امام رضا&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    }
]</code>
 </pre>
    </span>
<span id="execution-results-GETapi-public-listings-newest" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-public-listings-newest"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-public-listings-newest"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-public-listings-newest" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-public-listings-newest">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-public-listings-newest" data-method="GET"
      data-path="api/public/listings/newest"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-public-listings-newest', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-public-listings-newest"
                    onclick="tryItOut('GETapi-public-listings-newest');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-public-listings-newest"
                    onclick="cancelTryOut('GETapi-public-listings-newest');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-public-listings-newest"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/public/listings/newest</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-public-listings-newest"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-public-listings-newest"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="general-GETapi-public-listings-most-viewed">Get most viewed listings (ordered by view_count desc)</h2>

<p>
</p>



<span id="example-requests-GETapi-public-listings-most-viewed">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/public/listings/most-viewed" \
    --header "Accept: application/json" \
    --header "Content-Type: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/public/listings/most-viewed"
);

const headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-public-listings-most-viewed">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://localhost:3000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">[
    {
        &quot;id&quot;: 3,
        &quot;item_id&quot;: 3,
        &quot;title&quot;: &quot;اجاره لپ&zwnj;تاپ Dell&quot;,
        &quot;description&quot;: &quot;لپ&zwnj;تاپ با پردازنده قدرتمند&quot;,
        &quot;daily_fee&quot;: &quot;100000.00&quot;,
        &quot;deposit_amount&quot;: &quot;2000000.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-05T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-03-05T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 86,
        &quot;created_at&quot;: &quot;2026-01-05T06:50:33.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-05T10:37:46.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;item&quot;: {
            &quot;id&quot;: 3,
            &quot;owner_id&quot;: 3,
            &quot;category_id&quot;: 4,
            &quot;title&quot;: &quot;لپ&zwnj;تاپ Dell&quot;,
            &quot;description&quot;: &quot;لپ&zwnj;تاپ Dell با پردازنده Intel Core i7&quot;,
            &quot;item_condition&quot;: &quot;like_new&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/df5aa535e7670dd8789ca9b1d9135fe0.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 4,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;الکترونیکی&quot;,
                &quot;description&quot;: &quot;وسایل الکترونیکی&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 3,
                &quot;full_name&quot;: &quot;محمد کریمی&quot;,
                &quot;username&quot;: &quot;mohammad_karimi&quot;,
                &quot;email&quot;: &quot;mohammad@example.com&quot;,
                &quot;phone&quot;: &quot;09123456791&quot;,
                &quot;profile_image&quot;: null,
                &quot;trust_score&quot;: 4.2,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;شیراز، خیابان زند&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T16:19:24.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 4,
        &quot;item_id&quot;: 4,
        &quot;title&quot;: &quot;اجاره دوچرخه کوهستان&quot;,
        &quot;description&quot;: &quot;دوچرخه مناسب برای کوهنوردی&quot;,
        &quot;daily_fee&quot;: &quot;50000.00&quot;,
        &quot;deposit_amount&quot;: &quot;500000.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-05T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-05-05T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 58,
        &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-05T07:17:54.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;item&quot;: {
            &quot;id&quot;: 4,
            &quot;owner_id&quot;: 4,
            &quot;category_id&quot;: 6,
            &quot;title&quot;: &quot;دوچرخه کوهستان&quot;,
            &quot;description&quot;: &quot;دوچرخه کوهستان با کیفیت عالی&quot;,
            &quot;item_condition&quot;: &quot;used&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/bc2bb19f872f60496b11c3bac04fd520.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 6,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;ورزشی&quot;,
                &quot;description&quot;: &quot;وسایل ورزشی&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 4,
                &quot;full_name&quot;: &quot;زهرا نوری&quot;,
                &quot;username&quot;: &quot;zahra_noori&quot;,
                &quot;email&quot;: &quot;zahra@example.com&quot;,
                &quot;phone&quot;: &quot;09123456792&quot;,
                &quot;profile_image&quot;: null,
                &quot;trust_score&quot;: 4.7,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;مشهد، خیابان امام رضا&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 5,
        &quot;item_id&quot;: 5,
        &quot;title&quot;: &quot;اجاره جارو برقی&quot;,
        &quot;description&quot;: &quot;جارو برقی قدرتمند&quot;,
        &quot;daily_fee&quot;: &quot;20000.00&quot;,
        &quot;deposit_amount&quot;: &quot;300000.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-05T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-06-05T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 35,
        &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-06T12:42:40.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;item&quot;: {
            &quot;id&quot;: 5,
            &quot;owner_id&quot;: 1,
            &quot;category_id&quot;: 3,
            &quot;title&quot;: &quot;جارو برقی&quot;,
            &quot;description&quot;: &quot;جارو برقی قدرتمند&quot;,
            &quot;item_condition&quot;: &quot;like_new&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/b899ad0b235bc522afea8ff39c81790f.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 3,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;لوازم خانگی&quot;,
                &quot;description&quot;: &quot;لوازم خانگی&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 1,
                &quot;full_name&quot;: &quot;علی احمدی راد&quot;,
                &quot;username&quot;: &quot;ali_ahmadi&quot;,
                &quot;email&quot;: &quot;ali@example.com&quot;,
                &quot;phone&quot;: &quot;09123456789&quot;,
                &quot;profile_image&quot;: &quot;[\&quot;http://localhost:3000/items/da54db5b62ebf9c1a9b1a1b3bb3a605e.jpg\&quot;]&quot;,
                &quot;trust_score&quot;: 4.5,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;تهران، خیابان ولیعصر&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T16:12:13.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 6,
        &quot;item_id&quot;: 6,
        &quot;title&quot;: &quot;اجاره پازل 1000 تکه&quot;,
        &quot;description&quot;: &quot;پازل زیبا و سرگرم&zwnj;کننده&quot;,
        &quot;daily_fee&quot;: &quot;10000.00&quot;,
        &quot;deposit_amount&quot;: &quot;100000.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-05T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-07-05T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 27,
        &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-06T11:57:17.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;item&quot;: {
            &quot;id&quot;: 6,
            &quot;owner_id&quot;: 2,
            &quot;category_id&quot;: 5,
            &quot;title&quot;: &quot;پازل 1000 تکه&quot;,
            &quot;description&quot;: &quot;پازل زیبا با تصویر طبیعت&quot;,
            &quot;item_condition&quot;: &quot;new&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/6e6afbf4e39d88e8f1d377de945c82fa.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 5,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;اسباب بازی&quot;,
                &quot;description&quot;: &quot;اسباب بازی&zwnj;ها&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 2,
                &quot;full_name&quot;: &quot;مریم رضایی&quot;,
                &quot;username&quot;: &quot;maryam_rezaei&quot;,
                &quot;email&quot;: &quot;maryam@example.com&quot;,
                &quot;phone&quot;: &quot;09123456790&quot;,
                &quot;profile_image&quot;: null,
                &quot;trust_score&quot;: 4.8,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;اصفهان، خیابان چهارباغ&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T16:28:11.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 24,
        &quot;item_id&quot;: 23,
        &quot;title&quot;: &quot;دست&zwnj;های قوی&quot;,
        &quot;description&quot;: &quot;برای اوقات بیکاری  شما&quot;,
        &quot;daily_fee&quot;: &quot;27996.00&quot;,
        &quot;deposit_amount&quot;: &quot;283772.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 20,
        &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-06T12:30:18.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;item&quot;: {
            &quot;id&quot;: 23,
            &quot;owner_id&quot;: 1,
            &quot;category_id&quot;: 6,
            &quot;title&quot;: &quot;دست&zwnj;های قوی&quot;,
            &quot;description&quot;: &quot;برای اوقات بیکاری  شما&quot;,
            &quot;item_condition&quot;: &quot;new&quot;,
            &quot;images_json&quot;: &quot;[\&quot;http://localhost:3000/items/e05812eb7d02bcbf8cafd0cfee380da0.jpg\&quot;]&quot;,
            &quot;created_at&quot;: &quot;2026-01-06T13:58:20.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-06T11:12:16.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 6,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;ورزشی&quot;,
                &quot;description&quot;: &quot;وسایل ورزشی&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 1,
                &quot;full_name&quot;: &quot;علی احمدی راد&quot;,
                &quot;username&quot;: &quot;ali_ahmadi&quot;,
                &quot;email&quot;: &quot;ali@example.com&quot;,
                &quot;phone&quot;: &quot;09123456789&quot;,
                &quot;profile_image&quot;: &quot;[\&quot;http://localhost:3000/items/da54db5b62ebf9c1a9b1a1b3bb3a605e.jpg\&quot;]&quot;,
                &quot;trust_score&quot;: 4.5,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;تهران، خیابان ولیعصر&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T16:12:13.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 25,
        &quot;item_id&quot;: 24,
        &quot;title&quot;: &quot;آچار&quot;,
        &quot;description&quot;: &quot;برای تعمیرات خانگی&quot;,
        &quot;daily_fee&quot;: &quot;19783.00&quot;,
        &quot;deposit_amount&quot;: &quot;193278.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 18,
        &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-06T12:36:48.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;item&quot;: {
            &quot;id&quot;: 24,
            &quot;owner_id&quot;: 3,
            &quot;category_id&quot;: 2,
            &quot;title&quot;: &quot;آچار&quot;,
            &quot;description&quot;: &quot;برای تعمیرات خانگی&quot;,
            &quot;item_condition&quot;: &quot;used&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/ee501960fefe13840a013f3c18589c77.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-07T13:58:26.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T13:58:29.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 2,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;ابزار&quot;,
                &quot;description&quot;: &quot;ابزارهای مختلف&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T08:52:05.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 3,
                &quot;full_name&quot;: &quot;محمد کریمی&quot;,
                &quot;username&quot;: &quot;mohammad_karimi&quot;,
                &quot;email&quot;: &quot;mohammad@example.com&quot;,
                &quot;phone&quot;: &quot;09123456791&quot;,
                &quot;profile_image&quot;: null,
                &quot;trust_score&quot;: 4.2,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;شیراز، خیابان زند&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T16:19:24.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 26,
        &quot;item_id&quot;: 25,
        &quot;title&quot;: &quot;ابزار نجاری&quot;,
        &quot;description&quot;: &quot;یک صندلی چوبی بسازید&quot;,
        &quot;daily_fee&quot;: &quot;41964.00&quot;,
        &quot;deposit_amount&quot;: &quot;636689.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 12,
        &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-06T12:14:25.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;item&quot;: {
            &quot;id&quot;: 25,
            &quot;owner_id&quot;: 2,
            &quot;category_id&quot;: 2,
            &quot;title&quot;: &quot;ابزار نجاری&quot;,
            &quot;description&quot;: &quot;یک صندلی چوبی بسازید&quot;,
            &quot;item_condition&quot;: &quot;used&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/e6cb403e98a7f28b2c59e46f53a3a83d.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-06T13:58:33.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-04T13:58:36.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 2,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;ابزار&quot;,
                &quot;description&quot;: &quot;ابزارهای مختلف&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T08:52:05.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 2,
                &quot;full_name&quot;: &quot;مریم رضایی&quot;,
                &quot;username&quot;: &quot;maryam_rezaei&quot;,
                &quot;email&quot;: &quot;maryam@example.com&quot;,
                &quot;phone&quot;: &quot;09123456790&quot;,
                &quot;profile_image&quot;: null,
                &quot;trust_score&quot;: 4.8,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;اصفهان، خیابان چهارباغ&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T16:28:11.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 11,
        &quot;item_id&quot;: 10,
        &quot;title&quot;: &quot;جورچین کودکان&quot;,
        &quot;description&quot;: &quot;یک قلعه هزار رنگ بسازید و آخر هفته خود را شیرین&zwnj;تر کنید&quot;,
        &quot;daily_fee&quot;: &quot;12267.00&quot;,
        &quot;deposit_amount&quot;: &quot;165970.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 10,
        &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-06T17:14:58.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;item&quot;: {
            &quot;id&quot;: 10,
            &quot;owner_id&quot;: 2,
            &quot;category_id&quot;: 5,
            &quot;title&quot;: &quot;جورچین کودکان&quot;,
            &quot;description&quot;: &quot;یک قلعه هزار رنگ بسازید و آخر هفته خود را شیرین&zwnj;تر کنید&quot;,
            &quot;item_condition&quot;: &quot;used&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/2ad2e0775fe81e8fe6a4ccefc6636ee2.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-05T13:56:57.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T13:57:00.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 5,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;اسباب بازی&quot;,
                &quot;description&quot;: &quot;اسباب بازی&zwnj;ها&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 2,
                &quot;full_name&quot;: &quot;مریم رضایی&quot;,
                &quot;username&quot;: &quot;maryam_rezaei&quot;,
                &quot;email&quot;: &quot;maryam@example.com&quot;,
                &quot;phone&quot;: &quot;09123456790&quot;,
                &quot;profile_image&quot;: null,
                &quot;trust_score&quot;: 4.8,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;اصفهان، خیابان چهارباغ&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T16:28:11.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 22,
        &quot;item_id&quot;: 21,
        &quot;title&quot;: &quot;سیمون دوبووار&quot;,
        &quot;description&quot;: &quot;اگر به ادبیات سیاسی علاقه مندید این کتاب مناسب شماست&quot;,
        &quot;daily_fee&quot;: &quot;4032.00&quot;,
        &quot;deposit_amount&quot;: &quot;192781.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 6,
        &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-06T12:39:24.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;item&quot;: {
            &quot;id&quot;: 21,
            &quot;owner_id&quot;: 3,
            &quot;category_id&quot;: 1,
            &quot;title&quot;: &quot;سیمون دوبووار&quot;,
            &quot;description&quot;: &quot;اگر به ادبیات سیاسی علاقه مندید این کتاب مناسب شماست&quot;,
            &quot;item_condition&quot;: &quot;new&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/b5ede21269b3c45015526682602dc1eb.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-02T13:58:02.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-06T13:58:07.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 1,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;کتاب&quot;,
                &quot;description&quot;: &quot;کتاب&zwnj;های مختلف&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 3,
                &quot;full_name&quot;: &quot;محمد کریمی&quot;,
                &quot;username&quot;: &quot;mohammad_karimi&quot;,
                &quot;email&quot;: &quot;mohammad@example.com&quot;,
                &quot;phone&quot;: &quot;09123456791&quot;,
                &quot;profile_image&quot;: null,
                &quot;trust_score&quot;: 4.2,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;شیراز، خیابان زند&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T16:19:24.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 20,
        &quot;item_id&quot;: 19,
        &quot;title&quot;: &quot;هملت&quot;,
        &quot;description&quot;: &quot;نمایشنامه&zwnj;ای از اعماق تاریخ و هنر&quot;,
        &quot;daily_fee&quot;: &quot;7466.00&quot;,
        &quot;deposit_amount&quot;: &quot;199262.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 5,
        &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-06T12:42:45.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;item&quot;: {
            &quot;id&quot;: 19,
            &quot;owner_id&quot;: 2,
            &quot;category_id&quot;: 1,
            &quot;title&quot;: &quot;هملت&quot;,
            &quot;description&quot;: &quot;نمایشنامه&zwnj;ای از اعماق تاریخ و هنر&quot;,
            &quot;item_condition&quot;: &quot;old&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/1994376031428450fa5c2ac09eb4149c.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-05T13:57:51.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-06T13:57:54.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 1,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;کتاب&quot;,
                &quot;description&quot;: &quot;کتاب&zwnj;های مختلف&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 2,
                &quot;full_name&quot;: &quot;مریم رضایی&quot;,
                &quot;username&quot;: &quot;maryam_rezaei&quot;,
                &quot;email&quot;: &quot;maryam@example.com&quot;,
                &quot;phone&quot;: &quot;09123456790&quot;,
                &quot;profile_image&quot;: null,
                &quot;trust_score&quot;: 4.8,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;اصفهان، خیابان چهارباغ&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T16:28:11.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 12,
        &quot;item_id&quot;: 11,
        &quot;title&quot;: &quot;بدنسازی در خانه&quot;,
        &quot;description&quot;: &quot;برای ورک اوت در گاراژ خانه شما&quot;,
        &quot;daily_fee&quot;: &quot;29384.00&quot;,
        &quot;deposit_amount&quot;: &quot;171267.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 4,
        &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-06T12:38:48.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;item&quot;: {
            &quot;id&quot;: 11,
            &quot;owner_id&quot;: 2,
            &quot;category_id&quot;: 6,
            &quot;title&quot;: &quot;بدنسازی در خانه&quot;,
            &quot;description&quot;: &quot;برای ورک اوت در گاراژ خانه شما&quot;,
            &quot;item_condition&quot;: &quot;old&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/4d7fad73122f9185ce985bff268529c3.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-05T13:57:04.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T13:57:07.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 6,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;ورزشی&quot;,
                &quot;description&quot;: &quot;وسایل ورزشی&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 2,
                &quot;full_name&quot;: &quot;مریم رضایی&quot;,
                &quot;username&quot;: &quot;maryam_rezaei&quot;,
                &quot;email&quot;: &quot;maryam@example.com&quot;,
                &quot;phone&quot;: &quot;09123456790&quot;,
                &quot;profile_image&quot;: null,
                &quot;trust_score&quot;: 4.8,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;اصفهان، خیابان چهارباغ&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T16:28:11.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 13,
        &quot;item_id&quot;: 12,
        &quot;title&quot;: &quot;ابزار محاسبات&quot;,
        &quot;description&quot;: &quot;به عنوان یک کابینت&zwnj;ساز به دردتان می&zwnj;خورد&quot;,
        &quot;daily_fee&quot;: &quot;37482.00&quot;,
        &quot;deposit_amount&quot;: &quot;720663.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 4,
        &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-05T10:33:30.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;item&quot;: {
            &quot;id&quot;: 12,
            &quot;owner_id&quot;: 4,
            &quot;category_id&quot;: 2,
            &quot;title&quot;: &quot;ابزار محاسبات&quot;,
            &quot;description&quot;: &quot;به عنوان یک کابینت&zwnj;ساز به دردتان می&zwnj;خورد&quot;,
            &quot;item_condition&quot;: &quot;used&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/63a85aa0fde2237860b17411c6d4c057.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-05T13:57:10.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T13:57:13.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 2,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;ابزار&quot;,
                &quot;description&quot;: &quot;ابزارهای مختلف&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T08:52:05.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 4,
                &quot;full_name&quot;: &quot;زهرا نوری&quot;,
                &quot;username&quot;: &quot;zahra_noori&quot;,
                &quot;email&quot;: &quot;zahra@example.com&quot;,
                &quot;phone&quot;: &quot;09123456792&quot;,
                &quot;profile_image&quot;: null,
                &quot;trust_score&quot;: 4.7,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;مشهد، خیابان امام رضا&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 19,
        &quot;item_id&quot;: 18,
        &quot;title&quot;: &quot;ایروبیک در خانه&quot;,
        &quot;description&quot;: &quot;کلاس های آنلاین ورزش رات ثبت نام کرده و همیشه در خانه فیت بمانید&quot;,
        &quot;daily_fee&quot;: &quot;20369.00&quot;,
        &quot;deposit_amount&quot;: &quot;497940.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 4,
        &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-06T12:01:44.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;item&quot;: {
            &quot;id&quot;: 18,
            &quot;owner_id&quot;: 4,
            &quot;category_id&quot;: 6,
            &quot;title&quot;: &quot;ایروبیک در خانه&quot;,
            &quot;description&quot;: &quot;کلاس های آنلاین ورزش رات ثبت نام کرده و همیشه در خانه فیت بمانید&quot;,
            &quot;item_condition&quot;: &quot;new&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/881611da63292e272aa6564a237e5e08.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-05T13:57:44.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T13:57:48.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 6,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;ورزشی&quot;,
                &quot;description&quot;: &quot;وسایل ورزشی&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 4,
                &quot;full_name&quot;: &quot;زهرا نوری&quot;,
                &quot;username&quot;: &quot;zahra_noori&quot;,
                &quot;email&quot;: &quot;zahra@example.com&quot;,
                &quot;phone&quot;: &quot;09123456792&quot;,
                &quot;profile_image&quot;: null,
                &quot;trust_score&quot;: 4.7,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;مشهد، خیابان امام رضا&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 9,
        &quot;item_id&quot;: 8,
        &quot;title&quot;: &quot;عروسک ببعی&quot;,
        &quot;description&quot;: &quot;دوست مهربان و نرم کودکان&quot;,
        &quot;daily_fee&quot;: &quot;6714.00&quot;,
        &quot;deposit_amount&quot;: &quot;123502.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 2,
        &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-05T11:33:47.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;item&quot;: {
            &quot;id&quot;: 8,
            &quot;owner_id&quot;: 4,
            &quot;category_id&quot;: 5,
            &quot;title&quot;: &quot;عروسک ببعی&quot;,
            &quot;description&quot;: &quot;دوست مهربان و نرم کودکان&quot;,
            &quot;item_condition&quot;: &quot;new&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/0c16e7cbc7d74492d92dc71a97634258.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-06T13:56:44.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-06T13:56:47.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 5,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;اسباب بازی&quot;,
                &quot;description&quot;: &quot;اسباب بازی&zwnj;ها&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 4,
                &quot;full_name&quot;: &quot;زهرا نوری&quot;,
                &quot;username&quot;: &quot;zahra_noori&quot;,
                &quot;email&quot;: &quot;zahra@example.com&quot;,
                &quot;phone&quot;: &quot;09123456792&quot;,
                &quot;profile_image&quot;: null,
                &quot;trust_score&quot;: 4.7,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;مشهد، خیابان امام رضا&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 15,
        &quot;item_id&quot;: 14,
        &quot;title&quot;: &quot;موجودات ریز و بانمک&quot;,
        &quot;description&quot;: &quot;بچه&zwnj;های خود را به دنیایی از عجایت رنگارنگ بیاورید و اینطور داستان بگویید&quot;,
        &quot;daily_fee&quot;: &quot;9647.00&quot;,
        &quot;deposit_amount&quot;: &quot;149999.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 2,
        &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-06T11:21:43.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;item&quot;: {
            &quot;id&quot;: 14,
            &quot;owner_id&quot;: 4,
            &quot;category_id&quot;: 5,
            &quot;title&quot;: &quot;موجودات ریز و بانمک&quot;,
            &quot;description&quot;: &quot;بچه&zwnj;های خود را به دنیایی از عجایت رنگارنگ بیاورید و اینطور داستان بگویید&quot;,
            &quot;item_condition&quot;: &quot;like_new&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/546e1a781d354475da98753ca33984ab.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-05T13:57:23.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T13:57:27.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 5,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;اسباب بازی&quot;,
                &quot;description&quot;: &quot;اسباب بازی&zwnj;ها&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 4,
                &quot;full_name&quot;: &quot;زهرا نوری&quot;,
                &quot;username&quot;: &quot;zahra_noori&quot;,
                &quot;email&quot;: &quot;zahra@example.com&quot;,
                &quot;phone&quot;: &quot;09123456792&quot;,
                &quot;profile_image&quot;: null,
                &quot;trust_score&quot;: 4.7,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;مشهد، خیابان امام رضا&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    }
]</code>
 </pre>
    </span>
<span id="execution-results-GETapi-public-listings-most-viewed" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-public-listings-most-viewed"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-public-listings-most-viewed"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-public-listings-most-viewed" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-public-listings-most-viewed">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-public-listings-most-viewed" data-method="GET"
      data-path="api/public/listings/most-viewed"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-public-listings-most-viewed', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-public-listings-most-viewed"
                    onclick="tryItOut('GETapi-public-listings-most-viewed');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-public-listings-most-viewed"
                    onclick="cancelTryOut('GETapi-public-listings-most-viewed');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-public-listings-most-viewed"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/public/listings/most-viewed</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-public-listings-most-viewed"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-public-listings-most-viewed"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="general-GETapi-public-listings-most-borrowed">Get most borrowed listings (ordered by loans count)</h2>

<p>
</p>



<span id="example-requests-GETapi-public-listings-most-borrowed">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/public/listings/most-borrowed" \
    --header "Accept: application/json" \
    --header "Content-Type: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/public/listings/most-borrowed"
);

const headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-public-listings-most-borrowed">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://localhost:3000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">[
    {
        &quot;id&quot;: 9,
        &quot;item_id&quot;: 8,
        &quot;title&quot;: &quot;عروسک ببعی&quot;,
        &quot;description&quot;: &quot;دوست مهربان و نرم کودکان&quot;,
        &quot;daily_fee&quot;: &quot;6714.00&quot;,
        &quot;deposit_amount&quot;: &quot;123502.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 2,
        &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-05T11:33:47.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;loans_count&quot;: 1,
        &quot;item&quot;: {
            &quot;id&quot;: 8,
            &quot;owner_id&quot;: 4,
            &quot;category_id&quot;: 5,
            &quot;title&quot;: &quot;عروسک ببعی&quot;,
            &quot;description&quot;: &quot;دوست مهربان و نرم کودکان&quot;,
            &quot;item_condition&quot;: &quot;new&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/0c16e7cbc7d74492d92dc71a97634258.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-06T13:56:44.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-06T13:56:47.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 5,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;اسباب بازی&quot;,
                &quot;description&quot;: &quot;اسباب بازی&zwnj;ها&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 4,
                &quot;full_name&quot;: &quot;زهرا نوری&quot;,
                &quot;username&quot;: &quot;zahra_noori&quot;,
                &quot;email&quot;: &quot;zahra@example.com&quot;,
                &quot;phone&quot;: &quot;09123456792&quot;,
                &quot;profile_image&quot;: null,
                &quot;trust_score&quot;: 4.7,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;مشهد، خیابان امام رضا&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 13,
        &quot;item_id&quot;: 12,
        &quot;title&quot;: &quot;ابزار محاسبات&quot;,
        &quot;description&quot;: &quot;به عنوان یک کابینت&zwnj;ساز به دردتان می&zwnj;خورد&quot;,
        &quot;daily_fee&quot;: &quot;37482.00&quot;,
        &quot;deposit_amount&quot;: &quot;720663.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 4,
        &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-05T10:33:30.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;loans_count&quot;: 1,
        &quot;item&quot;: {
            &quot;id&quot;: 12,
            &quot;owner_id&quot;: 4,
            &quot;category_id&quot;: 2,
            &quot;title&quot;: &quot;ابزار محاسبات&quot;,
            &quot;description&quot;: &quot;به عنوان یک کابینت&zwnj;ساز به دردتان می&zwnj;خورد&quot;,
            &quot;item_condition&quot;: &quot;used&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/63a85aa0fde2237860b17411c6d4c057.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-05T13:57:10.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T13:57:13.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 2,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;ابزار&quot;,
                &quot;description&quot;: &quot;ابزارهای مختلف&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T08:52:05.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 4,
                &quot;full_name&quot;: &quot;زهرا نوری&quot;,
                &quot;username&quot;: &quot;zahra_noori&quot;,
                &quot;email&quot;: &quot;zahra@example.com&quot;,
                &quot;phone&quot;: &quot;09123456792&quot;,
                &quot;profile_image&quot;: null,
                &quot;trust_score&quot;: 4.7,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;مشهد، خیابان امام رضا&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 3,
        &quot;item_id&quot;: 3,
        &quot;title&quot;: &quot;اجاره لپ&zwnj;تاپ Dell&quot;,
        &quot;description&quot;: &quot;لپ&zwnj;تاپ با پردازنده قدرتمند&quot;,
        &quot;daily_fee&quot;: &quot;100000.00&quot;,
        &quot;deposit_amount&quot;: &quot;2000000.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-05T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-03-05T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 86,
        &quot;created_at&quot;: &quot;2026-01-05T06:50:33.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-05T10:37:46.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;loans_count&quot;: 1,
        &quot;item&quot;: {
            &quot;id&quot;: 3,
            &quot;owner_id&quot;: 3,
            &quot;category_id&quot;: 4,
            &quot;title&quot;: &quot;لپ&zwnj;تاپ Dell&quot;,
            &quot;description&quot;: &quot;لپ&zwnj;تاپ Dell با پردازنده Intel Core i7&quot;,
            &quot;item_condition&quot;: &quot;like_new&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/df5aa535e7670dd8789ca9b1d9135fe0.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 4,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;الکترونیکی&quot;,
                &quot;description&quot;: &quot;وسایل الکترونیکی&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 3,
                &quot;full_name&quot;: &quot;محمد کریمی&quot;,
                &quot;username&quot;: &quot;mohammad_karimi&quot;,
                &quot;email&quot;: &quot;mohammad@example.com&quot;,
                &quot;phone&quot;: &quot;09123456791&quot;,
                &quot;profile_image&quot;: null,
                &quot;trust_score&quot;: 4.2,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;شیراز، خیابان زند&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T16:19:24.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 8,
        &quot;item_id&quot;: 7,
        &quot;title&quot;: &quot;ابزار جنگلی&quot;,
        &quot;description&quot;: &quot;برای یک گردش امن و باصفا در جنگل&quot;,
        &quot;daily_fee&quot;: &quot;44808.00&quot;,
        &quot;deposit_amount&quot;: &quot;431398.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 0,
        &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;loans_count&quot;: 0,
        &quot;item&quot;: {
            &quot;id&quot;: 7,
            &quot;owner_id&quot;: 3,
            &quot;category_id&quot;: 2,
            &quot;title&quot;: &quot;ابزار جنگلی&quot;,
            &quot;description&quot;: &quot;برای یک گردش امن و باصفا در جنگل&quot;,
            &quot;item_condition&quot;: &quot;used&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/89fb9d307d6332a1c533d2dfa23ce554.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-05T13:56:31.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T13:56:39.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 2,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;ابزار&quot;,
                &quot;description&quot;: &quot;ابزارهای مختلف&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T08:52:05.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 3,
                &quot;full_name&quot;: &quot;محمد کریمی&quot;,
                &quot;username&quot;: &quot;mohammad_karimi&quot;,
                &quot;email&quot;: &quot;mohammad@example.com&quot;,
                &quot;phone&quot;: &quot;09123456791&quot;,
                &quot;profile_image&quot;: null,
                &quot;trust_score&quot;: 4.2,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;شیراز، خیابان زند&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T16:19:24.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 11,
        &quot;item_id&quot;: 10,
        &quot;title&quot;: &quot;جورچین کودکان&quot;,
        &quot;description&quot;: &quot;یک قلعه هزار رنگ بسازید و آخر هفته خود را شیرین&zwnj;تر کنید&quot;,
        &quot;daily_fee&quot;: &quot;12267.00&quot;,
        &quot;deposit_amount&quot;: &quot;165970.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 10,
        &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-06T17:14:58.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;loans_count&quot;: 0,
        &quot;item&quot;: {
            &quot;id&quot;: 10,
            &quot;owner_id&quot;: 2,
            &quot;category_id&quot;: 5,
            &quot;title&quot;: &quot;جورچین کودکان&quot;,
            &quot;description&quot;: &quot;یک قلعه هزار رنگ بسازید و آخر هفته خود را شیرین&zwnj;تر کنید&quot;,
            &quot;item_condition&quot;: &quot;used&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/2ad2e0775fe81e8fe6a4ccefc6636ee2.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-05T13:56:57.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T13:57:00.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 5,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;اسباب بازی&quot;,
                &quot;description&quot;: &quot;اسباب بازی&zwnj;ها&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 2,
                &quot;full_name&quot;: &quot;مریم رضایی&quot;,
                &quot;username&quot;: &quot;maryam_rezaei&quot;,
                &quot;email&quot;: &quot;maryam@example.com&quot;,
                &quot;phone&quot;: &quot;09123456790&quot;,
                &quot;profile_image&quot;: null,
                &quot;trust_score&quot;: 4.8,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;اصفهان، خیابان چهارباغ&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T16:28:11.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 12,
        &quot;item_id&quot;: 11,
        &quot;title&quot;: &quot;بدنسازی در خانه&quot;,
        &quot;description&quot;: &quot;برای ورک اوت در گاراژ خانه شما&quot;,
        &quot;daily_fee&quot;: &quot;29384.00&quot;,
        &quot;deposit_amount&quot;: &quot;171267.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 4,
        &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-06T12:38:48.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;loans_count&quot;: 0,
        &quot;item&quot;: {
            &quot;id&quot;: 11,
            &quot;owner_id&quot;: 2,
            &quot;category_id&quot;: 6,
            &quot;title&quot;: &quot;بدنسازی در خانه&quot;,
            &quot;description&quot;: &quot;برای ورک اوت در گاراژ خانه شما&quot;,
            &quot;item_condition&quot;: &quot;old&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/4d7fad73122f9185ce985bff268529c3.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-05T13:57:04.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T13:57:07.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 6,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;ورزشی&quot;,
                &quot;description&quot;: &quot;وسایل ورزشی&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 2,
                &quot;full_name&quot;: &quot;مریم رضایی&quot;,
                &quot;username&quot;: &quot;maryam_rezaei&quot;,
                &quot;email&quot;: &quot;maryam@example.com&quot;,
                &quot;phone&quot;: &quot;09123456790&quot;,
                &quot;profile_image&quot;: null,
                &quot;trust_score&quot;: 4.8,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;اصفهان، خیابان چهارباغ&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T16:28:11.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 14,
        &quot;item_id&quot;: 13,
        &quot;title&quot;: &quot;فیل چوبی&quot;,
        &quot;description&quot;: &quot;اسباب بازی دستساز و بی&zwnj;نهایت زیبای فیلی&quot;,
        &quot;daily_fee&quot;: &quot;13859.00&quot;,
        &quot;deposit_amount&quot;: &quot;104893.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 0,
        &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;loans_count&quot;: 0,
        &quot;item&quot;: {
            &quot;id&quot;: 13,
            &quot;owner_id&quot;: 3,
            &quot;category_id&quot;: 5,
            &quot;title&quot;: &quot;فیل چوبی&quot;,
            &quot;description&quot;: &quot;اسباب بازی دستساز و بی&zwnj;نهایت زیبای فیلی&quot;,
            &quot;item_condition&quot;: &quot;like_new&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/95eb311980d9d95e7ae52f0a737e775b.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-05T13:57:16.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T13:57:20.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 5,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;اسباب بازی&quot;,
                &quot;description&quot;: &quot;اسباب بازی&zwnj;ها&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 3,
                &quot;full_name&quot;: &quot;محمد کریمی&quot;,
                &quot;username&quot;: &quot;mohammad_karimi&quot;,
                &quot;email&quot;: &quot;mohammad@example.com&quot;,
                &quot;phone&quot;: &quot;09123456791&quot;,
                &quot;profile_image&quot;: null,
                &quot;trust_score&quot;: 4.2,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;شیراز، خیابان زند&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T16:19:24.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 15,
        &quot;item_id&quot;: 14,
        &quot;title&quot;: &quot;موجودات ریز و بانمک&quot;,
        &quot;description&quot;: &quot;بچه&zwnj;های خود را به دنیایی از عجایت رنگارنگ بیاورید و اینطور داستان بگویید&quot;,
        &quot;daily_fee&quot;: &quot;9647.00&quot;,
        &quot;deposit_amount&quot;: &quot;149999.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 2,
        &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-06T11:21:43.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;loans_count&quot;: 0,
        &quot;item&quot;: {
            &quot;id&quot;: 14,
            &quot;owner_id&quot;: 4,
            &quot;category_id&quot;: 5,
            &quot;title&quot;: &quot;موجودات ریز و بانمک&quot;,
            &quot;description&quot;: &quot;بچه&zwnj;های خود را به دنیایی از عجایت رنگارنگ بیاورید و اینطور داستان بگویید&quot;,
            &quot;item_condition&quot;: &quot;like_new&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/546e1a781d354475da98753ca33984ab.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-05T13:57:23.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T13:57:27.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 5,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;اسباب بازی&quot;,
                &quot;description&quot;: &quot;اسباب بازی&zwnj;ها&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 4,
                &quot;full_name&quot;: &quot;زهرا نوری&quot;,
                &quot;username&quot;: &quot;zahra_noori&quot;,
                &quot;email&quot;: &quot;zahra@example.com&quot;,
                &quot;phone&quot;: &quot;09123456792&quot;,
                &quot;profile_image&quot;: null,
                &quot;trust_score&quot;: 4.7,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;مشهد، خیابان امام رضا&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 16,
        &quot;item_id&quot;: 15,
        &quot;title&quot;: &quot;کتابی خیال&zwnj;انگیز&quot;,
        &quot;description&quot;: &quot;برای خانم&zwnj;هایی که زیاد اورتینک می&zwnj;کنند.&quot;,
        &quot;daily_fee&quot;: &quot;7280.00&quot;,
        &quot;deposit_amount&quot;: &quot;61188.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 2,
        &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-06T11:31:35.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;loans_count&quot;: 0,
        &quot;item&quot;: {
            &quot;id&quot;: 15,
            &quot;owner_id&quot;: 1,
            &quot;category_id&quot;: 1,
            &quot;title&quot;: &quot;کتابی خیال&zwnj;انگیز&quot;,
            &quot;description&quot;: &quot;برای خانم&zwnj;هایی که زیاد اورتینک می&zwnj;کنند.&quot;,
            &quot;item_condition&quot;: &quot;used&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/42151b6bb9ae2be8e2e08864a0bfacc1.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-05T13:57:31.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T13:57:34.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 1,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;کتاب&quot;,
                &quot;description&quot;: &quot;کتاب&zwnj;های مختلف&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 1,
                &quot;full_name&quot;: &quot;علی احمدی راد&quot;,
                &quot;username&quot;: &quot;ali_ahmadi&quot;,
                &quot;email&quot;: &quot;ali@example.com&quot;,
                &quot;phone&quot;: &quot;09123456789&quot;,
                &quot;profile_image&quot;: &quot;[\&quot;http://localhost:3000/items/da54db5b62ebf9c1a9b1a1b3bb3a605e.jpg\&quot;]&quot;,
                &quot;trust_score&quot;: 4.5,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;تهران، خیابان ولیعصر&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T16:12:13.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 17,
        &quot;item_id&quot;: 16,
        &quot;title&quot;: &quot;مکعب روبیک&quot;,
        &quot;description&quot;: &quot;اگر نوجوانتان باهوش هست این مناسب شماست&quot;,
        &quot;daily_fee&quot;: &quot;5806.00&quot;,
        &quot;deposit_amount&quot;: &quot;262822.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 0,
        &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;loans_count&quot;: 0,
        &quot;item&quot;: {
            &quot;id&quot;: 16,
            &quot;owner_id&quot;: 2,
            &quot;category_id&quot;: 5,
            &quot;title&quot;: &quot;مکعب روبیک&quot;,
            &quot;description&quot;: &quot;اگر نوجوانتان باهوش هست این مناسب شماست&quot;,
            &quot;item_condition&quot;: &quot;new&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/78371c77f1a3d7f9ded200c18242ae4e.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-05T13:57:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T13:57:41.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 5,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;اسباب بازی&quot;,
                &quot;description&quot;: &quot;اسباب بازی&zwnj;ها&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 2,
                &quot;full_name&quot;: &quot;مریم رضایی&quot;,
                &quot;username&quot;: &quot;maryam_rezaei&quot;,
                &quot;email&quot;: &quot;maryam@example.com&quot;,
                &quot;phone&quot;: &quot;09123456790&quot;,
                &quot;profile_image&quot;: null,
                &quot;trust_score&quot;: 4.8,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;اصفهان، خیابان چهارباغ&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T16:28:11.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 18,
        &quot;item_id&quot;: 17,
        &quot;title&quot;: &quot;اسکیت&zwnj;بورد گروهی&quot;,
        &quot;description&quot;: &quot;با اکیپ دوستانتان این ورزش جادویی را تجربه کنید&quot;,
        &quot;daily_fee&quot;: &quot;36573.00&quot;,
        &quot;deposit_amount&quot;: &quot;440176.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 0,
        &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;loans_count&quot;: 0,
        &quot;item&quot;: {
            &quot;id&quot;: 17,
            &quot;owner_id&quot;: 3,
            &quot;category_id&quot;: 6,
            &quot;title&quot;: &quot;اسکیت&zwnj;بورد گروهی&quot;,
            &quot;description&quot;: &quot;با اکیپ دوستانتان این ورزش جادویی را تجربه کنید&quot;,
            &quot;item_condition&quot;: &quot;used&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/293212be4ddd17d68acbfaac78d56586.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-06T14:23:19.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-06T14:23:24.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 6,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;ورزشی&quot;,
                &quot;description&quot;: &quot;وسایل ورزشی&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 3,
                &quot;full_name&quot;: &quot;محمد کریمی&quot;,
                &quot;username&quot;: &quot;mohammad_karimi&quot;,
                &quot;email&quot;: &quot;mohammad@example.com&quot;,
                &quot;phone&quot;: &quot;09123456791&quot;,
                &quot;profile_image&quot;: null,
                &quot;trust_score&quot;: 4.2,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;شیراز، خیابان زند&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T16:19:24.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 19,
        &quot;item_id&quot;: 18,
        &quot;title&quot;: &quot;ایروبیک در خانه&quot;,
        &quot;description&quot;: &quot;کلاس های آنلاین ورزش رات ثبت نام کرده و همیشه در خانه فیت بمانید&quot;,
        &quot;daily_fee&quot;: &quot;20369.00&quot;,
        &quot;deposit_amount&quot;: &quot;497940.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 4,
        &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-06T12:01:44.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;loans_count&quot;: 0,
        &quot;item&quot;: {
            &quot;id&quot;: 18,
            &quot;owner_id&quot;: 4,
            &quot;category_id&quot;: 6,
            &quot;title&quot;: &quot;ایروبیک در خانه&quot;,
            &quot;description&quot;: &quot;کلاس های آنلاین ورزش رات ثبت نام کرده و همیشه در خانه فیت بمانید&quot;,
            &quot;item_condition&quot;: &quot;new&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/881611da63292e272aa6564a237e5e08.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-05T13:57:44.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T13:57:48.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 6,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;ورزشی&quot;,
                &quot;description&quot;: &quot;وسایل ورزشی&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 4,
                &quot;full_name&quot;: &quot;زهرا نوری&quot;,
                &quot;username&quot;: &quot;zahra_noori&quot;,
                &quot;email&quot;: &quot;zahra@example.com&quot;,
                &quot;phone&quot;: &quot;09123456792&quot;,
                &quot;profile_image&quot;: null,
                &quot;trust_score&quot;: 4.7,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;مشهد، خیابان امام رضا&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 20,
        &quot;item_id&quot;: 19,
        &quot;title&quot;: &quot;هملت&quot;,
        &quot;description&quot;: &quot;نمایشنامه&zwnj;ای از اعماق تاریخ و هنر&quot;,
        &quot;daily_fee&quot;: &quot;7466.00&quot;,
        &quot;deposit_amount&quot;: &quot;199262.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 5,
        &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-06T12:42:45.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;loans_count&quot;: 0,
        &quot;item&quot;: {
            &quot;id&quot;: 19,
            &quot;owner_id&quot;: 2,
            &quot;category_id&quot;: 1,
            &quot;title&quot;: &quot;هملت&quot;,
            &quot;description&quot;: &quot;نمایشنامه&zwnj;ای از اعماق تاریخ و هنر&quot;,
            &quot;item_condition&quot;: &quot;old&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/1994376031428450fa5c2ac09eb4149c.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-05T13:57:51.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-06T13:57:54.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 1,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;کتاب&quot;,
                &quot;description&quot;: &quot;کتاب&zwnj;های مختلف&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 2,
                &quot;full_name&quot;: &quot;مریم رضایی&quot;,
                &quot;username&quot;: &quot;maryam_rezaei&quot;,
                &quot;email&quot;: &quot;maryam@example.com&quot;,
                &quot;phone&quot;: &quot;09123456790&quot;,
                &quot;profile_image&quot;: null,
                &quot;trust_score&quot;: 4.8,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;اصفهان، خیابان چهارباغ&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T16:28:11.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 21,
        &quot;item_id&quot;: 20,
        &quot;title&quot;: &quot;اسکیت&zwnj;بورد نوستالژی&quot;,
        &quot;description&quot;: &quot;مدتیه که گوشه اتاق مونده و اگه لازمش دارید بهتون قرض میدم&quot;,
        &quot;daily_fee&quot;: &quot;36047.00&quot;,
        &quot;deposit_amount&quot;: &quot;404534.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 2,
        &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-05T11:29:11.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;loans_count&quot;: 0,
        &quot;item&quot;: {
            &quot;id&quot;: 20,
            &quot;owner_id&quot;: 1,
            &quot;category_id&quot;: 6,
            &quot;title&quot;: &quot;اسکیت&zwnj;بورد نوستالژی&quot;,
            &quot;description&quot;: &quot;مدتیه که گوشه اتاق مونده و اگه لازمش دارید بهتون قرض میدم&quot;,
            &quot;item_condition&quot;: &quot;old&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/a22eda8cc9e2e7629fdeed8a2180183b.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-04T13:57:57.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-05T13:58:00.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 6,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;ورزشی&quot;,
                &quot;description&quot;: &quot;وسایل ورزشی&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 1,
                &quot;full_name&quot;: &quot;علی احمدی راد&quot;,
                &quot;username&quot;: &quot;ali_ahmadi&quot;,
                &quot;email&quot;: &quot;ali@example.com&quot;,
                &quot;phone&quot;: &quot;09123456789&quot;,
                &quot;profile_image&quot;: &quot;[\&quot;http://localhost:3000/items/da54db5b62ebf9c1a9b1a1b3bb3a605e.jpg\&quot;]&quot;,
                &quot;trust_score&quot;: 4.5,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;تهران، خیابان ولیعصر&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T16:12:13.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    },
    {
        &quot;id&quot;: 22,
        &quot;item_id&quot;: 21,
        &quot;title&quot;: &quot;سیمون دوبووار&quot;,
        &quot;description&quot;: &quot;اگر به ادبیات سیاسی علاقه مندید این کتاب مناسب شماست&quot;,
        &quot;daily_fee&quot;: &quot;4032.00&quot;,
        &quot;deposit_amount&quot;: &quot;192781.00&quot;,
        &quot;available_from&quot;: &quot;2026-01-06T00:00:00.000000Z&quot;,
        &quot;available_until&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;view_count&quot;: 6,
        &quot;created_at&quot;: &quot;2026-01-05T14:02:32.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-06T12:39:24.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;loans_count&quot;: 0,
        &quot;item&quot;: {
            &quot;id&quot;: 21,
            &quot;owner_id&quot;: 3,
            &quot;category_id&quot;: 1,
            &quot;title&quot;: &quot;سیمون دوبووار&quot;,
            &quot;description&quot;: &quot;اگر به ادبیات سیاسی علاقه مندید این کتاب مناسب شماست&quot;,
            &quot;item_condition&quot;: &quot;new&quot;,
            &quot;images_json&quot;: [
                &quot;http://localhost:3000/items/b5ede21269b3c45015526682602dc1eb.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-01-02T13:58:02.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-06T13:58:07.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;category&quot;: {
                &quot;id&quot;: 1,
                &quot;parent_id&quot;: null,
                &quot;title&quot;: &quot;کتاب&quot;,
                &quot;description&quot;: &quot;کتاب&zwnj;های مختلف&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;
            },
            &quot;owner&quot;: {
                &quot;id&quot;: 3,
                &quot;full_name&quot;: &quot;محمد کریمی&quot;,
                &quot;username&quot;: &quot;mohammad_karimi&quot;,
                &quot;email&quot;: &quot;mohammad@example.com&quot;,
                &quot;phone&quot;: &quot;09123456791&quot;,
                &quot;profile_image&quot;: null,
                &quot;trust_score&quot;: 4.2,
                &quot;role&quot;: 0,
                &quot;address&quot;: &quot;شیراز، خیابان زند&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-06T16:19:24.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    }
]</code>
 </pre>
    </span>
<span id="execution-results-GETapi-public-listings-most-borrowed" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-public-listings-most-borrowed"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-public-listings-most-borrowed"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-public-listings-most-borrowed" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-public-listings-most-borrowed">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-public-listings-most-borrowed" data-method="GET"
      data-path="api/public/listings/most-borrowed"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-public-listings-most-borrowed', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-public-listings-most-borrowed"
                    onclick="tryItOut('GETapi-public-listings-most-borrowed');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-public-listings-most-borrowed"
                    onclick="cancelTryOut('GETapi-public-listings-most-borrowed');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-public-listings-most-borrowed"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/public/listings/most-borrowed</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-public-listings-most-borrowed"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-public-listings-most-borrowed"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="general-GETapi-public-listings--id-">Display a specific listing for public/guest users.</h2>

<p>
</p>



<span id="example-requests-GETapi-public-listings--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/public/listings/2" \
    --header "Accept: application/json" \
    --header "Content-Type: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/public/listings/2"
);

const headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-public-listings--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://localhost:3000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: 2,
    &quot;item_id&quot;: 2,
    &quot;title&quot;: &quot;اجاره دریل برقی&quot;,
    &quot;description&quot;: &quot;دریل برقی با کیفیت&quot;,
    &quot;daily_fee&quot;: &quot;30000.00&quot;,
    &quot;deposit_amount&quot;: &quot;200000.00&quot;,
    &quot;available_from&quot;: &quot;2026-01-05T00:00:00.000000Z&quot;,
    &quot;available_until&quot;: &quot;2026-07-05T00:00:00.000000Z&quot;,
    &quot;status&quot;: &quot;paused&quot;,
    &quot;view_count&quot;: 53,
    &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
    &quot;updated_at&quot;: &quot;2026-01-06T11:00:50.000000Z&quot;,
    &quot;deleted_at&quot;: null,
    &quot;item&quot;: {
        &quot;id&quot;: 2,
        &quot;owner_id&quot;: 2,
        &quot;category_id&quot;: 2,
        &quot;title&quot;: &quot;دریل برقی&quot;,
        &quot;description&quot;: &quot;دریل برقی با کیفیت بالا&quot;,
        &quot;item_condition&quot;: &quot;used&quot;,
        &quot;images_json&quot;: [
            &quot;http://localhost:3000/items/da54db5b62ebf9c1a9b1a1b3bb3a605e.jpg&quot;
        ],
        &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;category&quot;: {
            &quot;id&quot;: 2,
            &quot;parent_id&quot;: null,
            &quot;title&quot;: &quot;ابزار&quot;,
            &quot;description&quot;: &quot;ابزارهای مختلف&quot;,
            &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-06T08:52:05.000000Z&quot;
        },
        &quot;owner&quot;: {
            &quot;id&quot;: 2,
            &quot;full_name&quot;: &quot;مریم رضایی&quot;,
            &quot;username&quot;: &quot;maryam_rezaei&quot;,
            &quot;email&quot;: &quot;maryam@example.com&quot;,
            &quot;phone&quot;: &quot;09123456790&quot;,
            &quot;profile_image&quot;: null,
            &quot;trust_score&quot;: 4.8,
            &quot;role&quot;: 0,
            &quot;address&quot;: &quot;اصفهان، خیابان چهارباغ&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-06T16:28:11.000000Z&quot;,
            &quot;deleted_at&quot;: null
        }
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-public-listings--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-public-listings--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-public-listings--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-public-listings--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-public-listings--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-public-listings--id-" data-method="GET"
      data-path="api/public/listings/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-public-listings--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-public-listings--id-"
                    onclick="tryItOut('GETapi-public-listings--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-public-listings--id-"
                    onclick="cancelTryOut('GETapi-public-listings--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-public-listings--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/public/listings/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-public-listings--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-public-listings--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-public-listings--id-"
               value="2"
               data-component="url">
    <br>
<p>The ID of the listing. Example: <code>2</code></p>
            </div>
                    </form>

                    <h2 id="general-GETapi-public-categories">Display all categories (with children for tree structure).</h2>

<p>
</p>



<span id="example-requests-GETapi-public-categories">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/public/categories" \
    --header "Accept: application/json" \
    --header "Content-Type: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/public/categories"
);

const headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-public-categories">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://localhost:3000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">[
    {
        &quot;id&quot;: 1,
        &quot;parent_id&quot;: null,
        &quot;title&quot;: &quot;کتاب&quot;,
        &quot;description&quot;: &quot;کتاب&zwnj;های مختلف&quot;,
        &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
        &quot;children&quot;: [
            {
                &quot;id&quot;: 7,
                &quot;parent_id&quot;: 1,
                &quot;title&quot;: &quot;رمان&quot;,
                &quot;description&quot;: &quot;رمان فارسی و انگلیسی&quot;,
                &quot;created_at&quot;: null,
                &quot;updated_at&quot;: null
            },
            {
                &quot;id&quot;: 8,
                &quot;parent_id&quot;: 1,
                &quot;title&quot;: &quot;کتاب دانشگاهی&quot;,
                &quot;description&quot;: &quot;کتب مرجع دانشگاهی&quot;,
                &quot;created_at&quot;: &quot;2026-01-05T09:33:20.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-01-05T09:33:44.000000Z&quot;
            }
        ]
    },
    {
        &quot;id&quot;: 2,
        &quot;parent_id&quot;: null,
        &quot;title&quot;: &quot;ابزار&quot;,
        &quot;description&quot;: &quot;ابزارهای مختلف&quot;,
        &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-06T08:52:05.000000Z&quot;,
        &quot;children&quot;: []
    },
    {
        &quot;id&quot;: 3,
        &quot;parent_id&quot;: null,
        &quot;title&quot;: &quot;لوازم خانگی&quot;,
        &quot;description&quot;: &quot;لوازم خانگی&quot;,
        &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
        &quot;children&quot;: []
    },
    {
        &quot;id&quot;: 4,
        &quot;parent_id&quot;: null,
        &quot;title&quot;: &quot;الکترونیکی&quot;,
        &quot;description&quot;: &quot;وسایل الکترونیکی&quot;,
        &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
        &quot;children&quot;: []
    },
    {
        &quot;id&quot;: 5,
        &quot;parent_id&quot;: null,
        &quot;title&quot;: &quot;اسباب بازی&quot;,
        &quot;description&quot;: &quot;اسباب بازی&zwnj;ها&quot;,
        &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
        &quot;children&quot;: []
    },
    {
        &quot;id&quot;: 6,
        &quot;parent_id&quot;: null,
        &quot;title&quot;: &quot;ورزشی&quot;,
        &quot;description&quot;: &quot;وسایل ورزشی&quot;,
        &quot;created_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-05T06:45:33.000000Z&quot;,
        &quot;children&quot;: []
    }
]</code>
 </pre>
    </span>
<span id="execution-results-GETapi-public-categories" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-public-categories"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-public-categories"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-public-categories" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-public-categories">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-public-categories" data-method="GET"
      data-path="api/public/categories"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-public-categories', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-public-categories"
                    onclick="tryItOut('GETapi-public-categories');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-public-categories"
                    onclick="cancelTryOut('GETapi-public-categories');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-public-categories"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/public/categories</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-public-categories"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-public-categories"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="general-POSTapi-forgot-password">POST api/forgot-password</h2>

<p>
</p>



<span id="example-requests-POSTapi-forgot-password">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/forgot-password" \
    --header "Accept: application/json" \
    --header "Content-Type: application/json" \
    --data "{
    \"email\": \"gbailey@example.net\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/forgot-password"
);

const headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
};

let body = {
    "email": "gbailey@example.net"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-forgot-password">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://localhost:3000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;در صورت وجود حساب، کد بازیابی ارسال شد&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-forgot-password" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-forgot-password"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-forgot-password"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-forgot-password" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-forgot-password">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-forgot-password" data-method="POST"
      data-path="api/forgot-password"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-forgot-password', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-forgot-password"
                    onclick="tryItOut('POSTapi-forgot-password');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-forgot-password"
                    onclick="cancelTryOut('POSTapi-forgot-password');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-forgot-password"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/forgot-password</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-forgot-password"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-forgot-password"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-forgot-password"
               value="gbailey@example.net"
               data-component="body">
    <br>
<p>Must be a valid email address. Example: <code>gbailey@example.net</code></p>
        </div>
        </form>

                    <h2 id="general-POSTapi-verify-reset-code">POST api/verify-reset-code</h2>

<p>
</p>



<span id="example-requests-POSTapi-verify-reset-code">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/verify-reset-code" \
    --header "Accept: application/json" \
    --header "Content-Type: application/json" \
    --data "{
    \"email\": \"gbailey@example.net\",
    \"code\": \"569775\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/verify-reset-code"
);

const headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
};

let body = {
    "email": "gbailey@example.net",
    "code": "569775"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-verify-reset-code">
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://localhost:3000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;کد نامعتبر یا منقضی شده&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-verify-reset-code" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-verify-reset-code"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-verify-reset-code"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-verify-reset-code" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-verify-reset-code">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-verify-reset-code" data-method="POST"
      data-path="api/verify-reset-code"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-verify-reset-code', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-verify-reset-code"
                    onclick="tryItOut('POSTapi-verify-reset-code');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-verify-reset-code"
                    onclick="cancelTryOut('POSTapi-verify-reset-code');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-verify-reset-code"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/verify-reset-code</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-verify-reset-code"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-verify-reset-code"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-verify-reset-code"
               value="gbailey@example.net"
               data-component="body">
    <br>
<p>Must be a valid email address. Example: <code>gbailey@example.net</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="code"                data-endpoint="POSTapi-verify-reset-code"
               value="569775"
               data-component="body">
    <br>
<p>Must be 6 digits. Example: <code>569775</code></p>
        </div>
        </form>

                    <h2 id="general-POSTapi-reset-password">POST api/reset-password</h2>

<p>
</p>



<span id="example-requests-POSTapi-reset-password">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/reset-password" \
    --header "Accept: application/json" \
    --header "Content-Type: application/json" \
    --data "{
    \"email\": \"gbailey@example.net\",
    \"code\": \"569775\",
    \"password\": \"]|{+-0pBNvYg\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/reset-password"
);

const headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
};

let body = {
    "email": "gbailey@example.net",
    "code": "569775",
    "password": "]|{+-0pBNvYg"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-reset-password">
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://localhost:3000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;کد نامعتبر یا منقضی شده&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-reset-password" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-reset-password"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-reset-password"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-reset-password" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-reset-password">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-reset-password" data-method="POST"
      data-path="api/reset-password"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-reset-password', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-reset-password"
                    onclick="tryItOut('POSTapi-reset-password');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-reset-password"
                    onclick="cancelTryOut('POSTapi-reset-password');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-reset-password"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/reset-password</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-reset-password"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-reset-password"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-reset-password"
               value="gbailey@example.net"
               data-component="body">
    <br>
<p>Must be a valid email address. Example: <code>gbailey@example.net</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="code"                data-endpoint="POSTapi-reset-password"
               value="569775"
               data-component="body">
    <br>
<p>Must be 6 digits. Example: <code>569775</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-reset-password"
               value="]|{+-0pBNvYg"
               data-component="body">
    <br>
<p>Must be at least 6 characters. Example: <code>]|{+-0pBNvYg</code></p>
        </div>
        </form>

                    <h2 id="general-POSTapi-logout">Logout user (revoke all tokens)</h2>

<p>
</p>



<span id="example-requests-POSTapi-logout">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/logout" \
    --header "Accept: application/json" \
    --header "Content-Type: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/logout"
);

const headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-logout">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://localhost:3000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-logout" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-logout"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-logout"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-logout" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-logout">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-logout" data-method="POST"
      data-path="api/logout"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-logout', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-logout"
                    onclick="tryItOut('POSTapi-logout');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-logout"
                    onclick="cancelTryOut('POSTapi-logout');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-logout"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/logout</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-logout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-logout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="general-GETapi-me">Get authenticated user details</h2>

<p>
</p>



<span id="example-requests-GETapi-me">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/me" \
    --header "Accept: application/json" \
    --header "Content-Type: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/me"
);

const headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-me">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://localhost:3000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-me" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-me"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-me"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-me" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-me">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-me" data-method="GET"
      data-path="api/me"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-me', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-me"
                    onclick="tryItOut('GETapi-me');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-me"
                    onclick="cancelTryOut('GETapi-me');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-me"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/me</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-me"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-me"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="general-GETapi-profile">GET api/profile</h2>

<p>
</p>



<span id="example-requests-GETapi-profile">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/profile" \
    --header "Accept: application/json" \
    --header "Content-Type: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/profile"
);

const headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-profile">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://localhost:3000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-profile" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-profile"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-profile"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-profile" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-profile">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-profile" data-method="GET"
      data-path="api/profile"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-profile', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-profile"
                    onclick="tryItOut('GETapi-profile');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-profile"
                    onclick="cancelTryOut('GETapi-profile');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-profile"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/profile</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-profile"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-profile"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="general-PUTapi-profile">PUT api/profile</h2>

<p>
</p>



<span id="example-requests-PUTapi-profile">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost:8000/api/profile" \
    --header "Accept: application/json" \
    --header "Content-Type: application/json" \
    --data "{
    \"full_name\": \"b\",
    \"phone\": \"n\",
    \"address\": \"architecto\",
    \"profile_image\": \"architecto\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/profile"
);

const headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
};

let body = {
    "full_name": "b",
    "phone": "n",
    "address": "architecto",
    "profile_image": "architecto"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-profile">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://localhost:3000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-profile" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-profile"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-profile"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-profile" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-profile">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-profile" data-method="PUT"
      data-path="api/profile"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-profile', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-profile"
                    onclick="tryItOut('PUTapi-profile');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-profile"
                    onclick="cancelTryOut('PUTapi-profile');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-profile"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/profile</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-profile"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-profile"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>full_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="full_name"                data-endpoint="PUTapi-profile"
               value="b"
               data-component="body">
    <br>
<p>Must not be greater than 150 characters. Example: <code>b</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="PUTapi-profile"
               value=""
               data-component="body">
    <br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phone</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="phone"                data-endpoint="PUTapi-profile"
               value="n"
               data-component="body">
    <br>
<p>Must not be greater than 30 characters. Example: <code>n</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>address</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="address"                data-endpoint="PUTapi-profile"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>profile_image</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="profile_image"                data-endpoint="PUTapi-profile"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
        </form>

                    <h2 id="general-GETapi-items">Display a listing of the authenticated user&#039;s items.</h2>

<p>
</p>



<span id="example-requests-GETapi-items">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/items" \
    --header "Accept: application/json" \
    --header "Content-Type: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/items"
);

const headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-items">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://localhost:3000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-items" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-items"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-items"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-items" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-items">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-items" data-method="GET"
      data-path="api/items"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-items', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-items"
                    onclick="tryItOut('GETapi-items');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-items"
                    onclick="cancelTryOut('GETapi-items');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-items"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/items</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-items"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-items"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="general-POSTapi-items">Store a newly created item for the authenticated user.</h2>

<p>
</p>



<span id="example-requests-POSTapi-items">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/items" \
    --header "Accept: application/json" \
    --header "Content-Type: application/json" \
    --data "{
    \"category_id\": \"architecto\",
    \"title\": \"n\",
    \"description\": \"Eius et animi quos velit et.\",
    \"item_condition\": \"used\",
    \"images_json\": \"architecto\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/items"
);

const headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
};

let body = {
    "category_id": "architecto",
    "title": "n",
    "description": "Eius et animi quos velit et.",
    "item_condition": "used",
    "images_json": "architecto"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-items">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://localhost:3000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-items" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-items"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-items"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-items" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-items">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-items" data-method="POST"
      data-path="api/items"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-items', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-items"
                    onclick="tryItOut('POSTapi-items');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-items"
                    onclick="cancelTryOut('POSTapi-items');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-items"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/items</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-items"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-items"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>category_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="category_id"                data-endpoint="POSTapi-items"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the categories table. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="title"                data-endpoint="POSTapi-items"
               value="n"
               data-component="body">
    <br>
<p>Must not be greater than 200 characters. Example: <code>n</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="POSTapi-items"
               value="Eius et animi quos velit et."
               data-component="body">
    <br>
<p>Example: <code>Eius et animi quos velit et.</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>item_condition</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="item_condition"                data-endpoint="POSTapi-items"
               value="used"
               data-component="body">
    <br>
<p>Example: <code>used</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>new</code></li> <li><code>like_new</code></li> <li><code>used</code></li> <li><code>old</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>images_json</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="images_json"                data-endpoint="POSTapi-items"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
        </form>

                    <h2 id="general-GETapi-items--id-">Display the specified item (only if belongs to user).</h2>

<p>
</p>



<span id="example-requests-GETapi-items--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/items/1" \
    --header "Accept: application/json" \
    --header "Content-Type: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/items/1"
);

const headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-items--id-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://localhost:3000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-items--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-items--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-items--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-items--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-items--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-items--id-" data-method="GET"
      data-path="api/items/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-items--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-items--id-"
                    onclick="tryItOut('GETapi-items--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-items--id-"
                    onclick="cancelTryOut('GETapi-items--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-items--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/items/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-items--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-items--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-items--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the item. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="general-PUTapi-items--id-">Update the specified item (only if belongs to user).</h2>

<p>
</p>



<span id="example-requests-PUTapi-items--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost:8000/api/items/1" \
    --header "Accept: application/json" \
    --header "Content-Type: application/json" \
    --data "{
    \"title\": \"b\",
    \"description\": \"Eius et animi quos velit et.\",
    \"item_condition\": \"old\",
    \"images_json\": \"architecto\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/items/1"
);

const headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
};

let body = {
    "title": "b",
    "description": "Eius et animi quos velit et.",
    "item_condition": "old",
    "images_json": "architecto"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-items--id-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://localhost:3000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-items--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-items--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-items--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-items--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-items--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-items--id-" data-method="PUT"
      data-path="api/items/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-items--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-items--id-"
                    onclick="tryItOut('PUTapi-items--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-items--id-"
                    onclick="cancelTryOut('PUTapi-items--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-items--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/items/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/items/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-items--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-items--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-items--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the item. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="title"                data-endpoint="PUTapi-items--id-"
               value="b"
               data-component="body">
    <br>
<p>Must not be greater than 200 characters. Example: <code>b</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="PUTapi-items--id-"
               value="Eius et animi quos velit et."
               data-component="body">
    <br>
<p>Example: <code>Eius et animi quos velit et.</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>item_condition</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="item_condition"                data-endpoint="PUTapi-items--id-"
               value="old"
               data-component="body">
    <br>
<p>Example: <code>old</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>new</code></li> <li><code>like_new</code></li> <li><code>used</code></li> <li><code>old</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>images_json</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="images_json"                data-endpoint="PUTapi-items--id-"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
        </form>

                    <h2 id="general-DELETEapi-items--id-">Remove the specified item (soft delete).</h2>

<p>
</p>



<span id="example-requests-DELETEapi-items--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost:8000/api/items/1" \
    --header "Accept: application/json" \
    --header "Content-Type: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/items/1"
);

const headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-items--id-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://localhost:3000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-DELETEapi-items--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-items--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-items--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-items--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-items--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-items--id-" data-method="DELETE"
      data-path="api/items/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-items--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-items--id-"
                    onclick="tryItOut('DELETEapi-items--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-items--id-"
                    onclick="cancelTryOut('DELETEapi-items--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-items--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/items/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-items--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-items--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-items--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the item. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="general-GETapi-listings">Display listings of the authenticated user&#039;s items.</h2>

<p>
</p>

<p>For admin users, return all listings.</p>

<span id="example-requests-GETapi-listings">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/listings" \
    --header "Accept: application/json" \
    --header "Content-Type: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/listings"
);

const headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-listings">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://localhost:3000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-listings" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-listings"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-listings"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-listings" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-listings">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-listings" data-method="GET"
      data-path="api/listings"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-listings', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-listings"
                    onclick="tryItOut('GETapi-listings');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-listings"
                    onclick="cancelTryOut('GETapi-listings');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-listings"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/listings</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-listings"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-listings"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="general-POSTapi-listings">Store a new listing for an item owned by the user.</h2>

<p>
</p>



<span id="example-requests-POSTapi-listings">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/listings" \
    --header "Accept: application/json" \
    --header "Content-Type: application/json" \
    --data "{
    \"item_id\": \"architecto\",
    \"title\": \"n\",
    \"description\": \"Eius et animi quos velit et.\",
    \"daily_fee\": 60,
    \"deposit_amount\": 42,
    \"available_from\": \"2026-01-06T17:43:47\",
    \"available_until\": \"2052-01-30\",
    \"status\": \"active\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/listings"
);

const headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
};

let body = {
    "item_id": "architecto",
    "title": "n",
    "description": "Eius et animi quos velit et.",
    "daily_fee": 60,
    "deposit_amount": 42,
    "available_from": "2026-01-06T17:43:47",
    "available_until": "2052-01-30",
    "status": "active"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-listings">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://localhost:3000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-listings" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-listings"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-listings"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-listings" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-listings">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-listings" data-method="POST"
      data-path="api/listings"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-listings', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-listings"
                    onclick="tryItOut('POSTapi-listings');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-listings"
                    onclick="cancelTryOut('POSTapi-listings');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-listings"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/listings</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-listings"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-listings"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>item_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="item_id"                data-endpoint="POSTapi-listings"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the items table. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="title"                data-endpoint="POSTapi-listings"
               value="n"
               data-component="body">
    <br>
<p>Must not be greater than 200 characters. Example: <code>n</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="POSTapi-listings"
               value="Eius et animi quos velit et."
               data-component="body">
    <br>
<p>Example: <code>Eius et animi quos velit et.</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>daily_fee</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="daily_fee"                data-endpoint="POSTapi-listings"
               value="60"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>60</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>deposit_amount</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="deposit_amount"                data-endpoint="POSTapi-listings"
               value="42"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>42</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>available_from</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="available_from"                data-endpoint="POSTapi-listings"
               value="2026-01-06T17:43:47"
               data-component="body">
    <br>
<p>Must be a valid date. Example: <code>2026-01-06T17:43:47</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>available_until</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="available_until"                data-endpoint="POSTapi-listings"
               value="2052-01-30"
               data-component="body">
    <br>
<p>Must be a valid date. Must be a date after or equal to <code>available_from</code>. Example: <code>2052-01-30</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="POSTapi-listings"
               value="active"
               data-component="body">
    <br>
<p>Example: <code>active</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>active</code></li> <li><code>paused</code></li> <li><code>expired</code></li></ul>
        </div>
        </form>

                    <h2 id="general-GETapi-listings--id-">Display a specific listing (only if item belongs to user).</h2>

<p>
</p>



<span id="example-requests-GETapi-listings--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/listings/2" \
    --header "Accept: application/json" \
    --header "Content-Type: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/listings/2"
);

const headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-listings--id-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://localhost:3000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-listings--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-listings--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-listings--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-listings--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-listings--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-listings--id-" data-method="GET"
      data-path="api/listings/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-listings--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-listings--id-"
                    onclick="tryItOut('GETapi-listings--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-listings--id-"
                    onclick="cancelTryOut('GETapi-listings--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-listings--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/listings/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-listings--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-listings--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-listings--id-"
               value="2"
               data-component="url">
    <br>
<p>The ID of the listing. Example: <code>2</code></p>
            </div>
                    </form>

                    <h2 id="general-PUTapi-listings--id-">Update the listing.</h2>

<p>
</p>



<span id="example-requests-PUTapi-listings--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost:8000/api/listings/2" \
    --header "Accept: application/json" \
    --header "Content-Type: application/json" \
    --data "{
    \"title\": \"b\",
    \"description\": \"Eius et animi quos velit et.\",
    \"daily_fee\": 60,
    \"deposit_amount\": 42,
    \"available_from\": \"2026-01-06T17:43:47\",
    \"available_until\": \"2052-01-30\",
    \"status\": \"expired\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/listings/2"
);

const headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
};

let body = {
    "title": "b",
    "description": "Eius et animi quos velit et.",
    "daily_fee": 60,
    "deposit_amount": 42,
    "available_from": "2026-01-06T17:43:47",
    "available_until": "2052-01-30",
    "status": "expired"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-listings--id-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://localhost:3000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-listings--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-listings--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-listings--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-listings--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-listings--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-listings--id-" data-method="PUT"
      data-path="api/listings/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-listings--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-listings--id-"
                    onclick="tryItOut('PUTapi-listings--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-listings--id-"
                    onclick="cancelTryOut('PUTapi-listings--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-listings--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/listings/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/listings/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-listings--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-listings--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-listings--id-"
               value="2"
               data-component="url">
    <br>
<p>The ID of the listing. Example: <code>2</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="title"                data-endpoint="PUTapi-listings--id-"
               value="b"
               data-component="body">
    <br>
<p>Must not be greater than 200 characters. Example: <code>b</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="PUTapi-listings--id-"
               value="Eius et animi quos velit et."
               data-component="body">
    <br>
<p>Example: <code>Eius et animi quos velit et.</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>daily_fee</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="daily_fee"                data-endpoint="PUTapi-listings--id-"
               value="60"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>60</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>deposit_amount</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="deposit_amount"                data-endpoint="PUTapi-listings--id-"
               value="42"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>42</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>available_from</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="available_from"                data-endpoint="PUTapi-listings--id-"
               value="2026-01-06T17:43:47"
               data-component="body">
    <br>
<p>Must be a valid date. Example: <code>2026-01-06T17:43:47</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>available_until</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="available_until"                data-endpoint="PUTapi-listings--id-"
               value="2052-01-30"
               data-component="body">
    <br>
<p>Must be a valid date. Must be a date after or equal to <code>available_from</code>. Example: <code>2052-01-30</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="PUTapi-listings--id-"
               value="expired"
               data-component="body">
    <br>
<p>Example: <code>expired</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>active</code></li> <li><code>paused</code></li> <li><code>expired</code></li></ul>
        </div>
        </form>

                    <h2 id="general-DELETEapi-listings--id-">Soft delete the listing.</h2>

<p>
</p>



<span id="example-requests-DELETEapi-listings--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost:8000/api/listings/2" \
    --header "Accept: application/json" \
    --header "Content-Type: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/listings/2"
);

const headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-listings--id-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://localhost:3000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-DELETEapi-listings--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-listings--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-listings--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-listings--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-listings--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-listings--id-" data-method="DELETE"
      data-path="api/listings/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-listings--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-listings--id-"
                    onclick="tryItOut('DELETEapi-listings--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-listings--id-"
                    onclick="cancelTryOut('DELETEapi-listings--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-listings--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/listings/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-listings--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-listings--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-listings--id-"
               value="2"
               data-component="url">
    <br>
<p>The ID of the listing. Example: <code>2</code></p>
            </div>
                    </form>

                    <h2 id="general-GETapi-my-loans">Loans related to authenticated user</h2>

<p>
</p>



<span id="example-requests-GETapi-my-loans">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/my-loans" \
    --header "Accept: application/json" \
    --header "Content-Type: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/my-loans"
);

const headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-my-loans">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://localhost:3000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-my-loans" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-my-loans"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-my-loans"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-my-loans" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-my-loans">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-my-loans" data-method="GET"
      data-path="api/my-loans"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-my-loans', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-my-loans"
                    onclick="tryItOut('GETapi-my-loans');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-my-loans"
                    onclick="cancelTryOut('GETapi-my-loans');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-my-loans"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/my-loans</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-my-loans"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-my-loans"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="general-POSTapi-loans--loan_id--approve">Approve loan</h2>

<p>
</p>



<span id="example-requests-POSTapi-loans--loan_id--approve">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/loans/1/approve" \
    --header "Accept: application/json" \
    --header "Content-Type: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/loans/1/approve"
);

const headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-loans--loan_id--approve">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://localhost:3000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-loans--loan_id--approve" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-loans--loan_id--approve"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-loans--loan_id--approve"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-loans--loan_id--approve" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-loans--loan_id--approve">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-loans--loan_id--approve" data-method="POST"
      data-path="api/loans/{loan_id}/approve"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-loans--loan_id--approve', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-loans--loan_id--approve"
                    onclick="tryItOut('POSTapi-loans--loan_id--approve');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-loans--loan_id--approve"
                    onclick="cancelTryOut('POSTapi-loans--loan_id--approve');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-loans--loan_id--approve"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/loans/{loan_id}/approve</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-loans--loan_id--approve"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-loans--loan_id--approve"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>loan_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="loan_id"                data-endpoint="POSTapi-loans--loan_id--approve"
               value="1"
               data-component="url">
    <br>
<p>The ID of the loan. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="general-POSTapi-loans--loan_id--reject">Reject loan</h2>

<p>
</p>



<span id="example-requests-POSTapi-loans--loan_id--reject">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/loans/1/reject" \
    --header "Accept: application/json" \
    --header "Content-Type: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/loans/1/reject"
);

const headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-loans--loan_id--reject">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://localhost:3000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-loans--loan_id--reject" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-loans--loan_id--reject"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-loans--loan_id--reject"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-loans--loan_id--reject" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-loans--loan_id--reject">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-loans--loan_id--reject" data-method="POST"
      data-path="api/loans/{loan_id}/reject"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-loans--loan_id--reject', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-loans--loan_id--reject"
                    onclick="tryItOut('POSTapi-loans--loan_id--reject');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-loans--loan_id--reject"
                    onclick="cancelTryOut('POSTapi-loans--loan_id--reject');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-loans--loan_id--reject"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/loans/{loan_id}/reject</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-loans--loan_id--reject"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-loans--loan_id--reject"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>loan_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="loan_id"                data-endpoint="POSTapi-loans--loan_id--reject"
               value="1"
               data-component="url">
    <br>
<p>The ID of the loan. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="general-POSTapi-loans">Create loan request</h2>

<p>
</p>



<span id="example-requests-POSTapi-loans">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/loans" \
    --header "Accept: application/json" \
    --header "Content-Type: application/json" \
    --data "{
    \"listing_id\": \"architecto\",
    \"start_date\": \"2052-01-30\",
    \"end_date\": \"2052-01-30\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/loans"
);

const headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
};

let body = {
    "listing_id": "architecto",
    "start_date": "2052-01-30",
    "end_date": "2052-01-30"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-loans">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://localhost:3000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-loans" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-loans"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-loans"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-loans" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-loans">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-loans" data-method="POST"
      data-path="api/loans"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-loans', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-loans"
                    onclick="tryItOut('POSTapi-loans');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-loans"
                    onclick="cancelTryOut('POSTapi-loans');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-loans"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/loans</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-loans"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-loans"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>listing_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="listing_id"                data-endpoint="POSTapi-loans"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the listings table. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>start_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="start_date"                data-endpoint="POSTapi-loans"
               value="2052-01-30"
               data-component="body">
    <br>
<p>Must be a valid date. Must be a date after or equal to <code>today</code>. Example: <code>2052-01-30</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>end_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="end_date"                data-endpoint="POSTapi-loans"
               value="2052-01-30"
               data-component="body">
    <br>
<p>Must be a valid date. Must be a date after <code>start_date</code>. Example: <code>2052-01-30</code></p>
        </div>
        </form>

                    <h2 id="general-GETapi-loans--id-">GET api/loans/{id}</h2>

<p>
</p>



<span id="example-requests-GETapi-loans--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/loans/1" \
    --header "Accept: application/json" \
    --header "Content-Type: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/loans/1"
);

const headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-loans--id-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://localhost:3000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-loans--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-loans--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-loans--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-loans--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-loans--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-loans--id-" data-method="GET"
      data-path="api/loans/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-loans--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-loans--id-"
                    onclick="tryItOut('GETapi-loans--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-loans--id-"
                    onclick="cancelTryOut('GETapi-loans--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-loans--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/loans/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-loans--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-loans--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-loans--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the loan. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="general-GETapi-conversations">GET api/conversations</h2>

<p>
</p>



<span id="example-requests-GETapi-conversations">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/conversations" \
    --header "Accept: application/json" \
    --header "Content-Type: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/conversations"
);

const headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-conversations">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://localhost:3000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-conversations" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-conversations"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-conversations"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-conversations" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-conversations">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-conversations" data-method="GET"
      data-path="api/conversations"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-conversations', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-conversations"
                    onclick="tryItOut('GETapi-conversations');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-conversations"
                    onclick="cancelTryOut('GETapi-conversations');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-conversations"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/conversations</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-conversations"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-conversations"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="general-GETapi-messages--conversation_id-">GET api/messages/{conversation_id}</h2>

<p>
</p>



<span id="example-requests-GETapi-messages--conversation_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/messages/1" \
    --header "Accept: application/json" \
    --header "Content-Type: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/messages/1"
);

const headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-messages--conversation_id-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://localhost:3000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-messages--conversation_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-messages--conversation_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-messages--conversation_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-messages--conversation_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-messages--conversation_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-messages--conversation_id-" data-method="GET"
      data-path="api/messages/{conversation_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-messages--conversation_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-messages--conversation_id-"
                    onclick="tryItOut('GETapi-messages--conversation_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-messages--conversation_id-"
                    onclick="cancelTryOut('GETapi-messages--conversation_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-messages--conversation_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/messages/{conversation_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-messages--conversation_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-messages--conversation_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>conversation_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="conversation_id"                data-endpoint="GETapi-messages--conversation_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the conversation. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="general-POSTapi-messages">POST api/messages</h2>

<p>
</p>



<span id="example-requests-POSTapi-messages">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/messages" \
    --header "Accept: application/json" \
    --header "Content-Type: application/json" \
    --data "{
    \"conversation_id\": \"architecto\",
    \"message_text\": \"architecto\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/messages"
);

const headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
};

let body = {
    "conversation_id": "architecto",
    "message_text": "architecto"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-messages">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://localhost:3000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-messages" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-messages"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-messages"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-messages" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-messages">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-messages" data-method="POST"
      data-path="api/messages"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-messages', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-messages"
                    onclick="tryItOut('POSTapi-messages');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-messages"
                    onclick="cancelTryOut('POSTapi-messages');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-messages"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/messages</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-messages"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-messages"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>conversation_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="conversation_id"                data-endpoint="POSTapi-messages"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the conversations table. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>message_text</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="message_text"                data-endpoint="POSTapi-messages"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
        </form>

                    <h2 id="general-GETapi-admin-conversation">Get or create conversation with admin (for support chat)</h2>

<p>
</p>



<span id="example-requests-GETapi-admin-conversation">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/admin-conversation" \
    --header "Accept: application/json" \
    --header "Content-Type: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/admin-conversation"
);

const headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-admin-conversation">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://localhost:3000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-admin-conversation" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-admin-conversation"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-admin-conversation"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-admin-conversation" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-admin-conversation">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-admin-conversation" data-method="GET"
      data-path="api/admin-conversation"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-admin-conversation', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-admin-conversation"
                    onclick="tryItOut('GETapi-admin-conversation');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-admin-conversation"
                    onclick="cancelTryOut('GETapi-admin-conversation');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-admin-conversation"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/admin-conversation</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-admin-conversation"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-admin-conversation"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="general-GETapi-admin-users">GET api/admin/users</h2>

<p>
</p>



<span id="example-requests-GETapi-admin-users">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/admin/users" \
    --header "Accept: application/json" \
    --header "Content-Type: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/admin/users"
);

const headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-admin-users">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://localhost:3000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-admin-users" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-admin-users"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-admin-users"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-admin-users" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-admin-users">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-admin-users" data-method="GET"
      data-path="api/admin/users"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-admin-users', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-admin-users"
                    onclick="tryItOut('GETapi-admin-users');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-admin-users"
                    onclick="cancelTryOut('GETapi-admin-users');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-admin-users"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/admin/users</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-admin-users"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-admin-users"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="general-GETapi-admin-users--user_id-">GET api/admin/users/{user_id}</h2>

<p>
</p>



<span id="example-requests-GETapi-admin-users--user_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/admin/users/1" \
    --header "Accept: application/json" \
    --header "Content-Type: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/admin/users/1"
);

const headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-admin-users--user_id-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://localhost:3000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-admin-users--user_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-admin-users--user_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-admin-users--user_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-admin-users--user_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-admin-users--user_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-admin-users--user_id-" data-method="GET"
      data-path="api/admin/users/{user_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-admin-users--user_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-admin-users--user_id-"
                    onclick="tryItOut('GETapi-admin-users--user_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-admin-users--user_id-"
                    onclick="cancelTryOut('GETapi-admin-users--user_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-admin-users--user_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/admin/users/{user_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-admin-users--user_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-admin-users--user_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>user_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="user_id"                data-endpoint="GETapi-admin-users--user_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the user. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="general-GETapi-admin-categories">Display all categories (with children for tree structure).</h2>

<p>
</p>



<span id="example-requests-GETapi-admin-categories">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/admin/categories" \
    --header "Accept: application/json" \
    --header "Content-Type: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/admin/categories"
);

const headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-admin-categories">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://localhost:3000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-admin-categories" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-admin-categories"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-admin-categories"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-admin-categories" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-admin-categories">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-admin-categories" data-method="GET"
      data-path="api/admin/categories"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-admin-categories', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-admin-categories"
                    onclick="tryItOut('GETapi-admin-categories');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-admin-categories"
                    onclick="cancelTryOut('GETapi-admin-categories');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-admin-categories"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/admin/categories</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-admin-categories"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-admin-categories"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="general-POSTapi-admin-categories">Store a new category (Admin only)</h2>

<p>
</p>



<span id="example-requests-POSTapi-admin-categories">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/admin/categories" \
    --header "Accept: application/json" \
    --header "Content-Type: application/json" \
    --data "{
    \"title\": \"b\",
    \"description\": \"Eius et animi quos velit et.\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/admin/categories"
);

const headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
};

let body = {
    "title": "b",
    "description": "Eius et animi quos velit et."
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-admin-categories">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://localhost:3000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-admin-categories" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-admin-categories"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-admin-categories"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-admin-categories" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-admin-categories">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-admin-categories" data-method="POST"
      data-path="api/admin/categories"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-admin-categories', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-admin-categories"
                    onclick="tryItOut('POSTapi-admin-categories');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-admin-categories"
                    onclick="cancelTryOut('POSTapi-admin-categories');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-admin-categories"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/admin/categories</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-admin-categories"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-admin-categories"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="title"                data-endpoint="POSTapi-admin-categories"
               value="b"
               data-component="body">
    <br>
<p>Must not be greater than 150 characters. Example: <code>b</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="POSTapi-admin-categories"
               value="Eius et animi quos velit et."
               data-component="body">
    <br>
<p>Example: <code>Eius et animi quos velit et.</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>parent_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="parent_id"                data-endpoint="POSTapi-admin-categories"
               value=""
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the categories table.</p>
        </div>
        </form>

                    <h2 id="general-GETapi-admin-categories--id-">Display a single category with its items.</h2>

<p>
</p>



<span id="example-requests-GETapi-admin-categories--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/admin/categories/1" \
    --header "Accept: application/json" \
    --header "Content-Type: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/admin/categories/1"
);

const headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-admin-categories--id-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://localhost:3000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-admin-categories--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-admin-categories--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-admin-categories--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-admin-categories--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-admin-categories--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-admin-categories--id-" data-method="GET"
      data-path="api/admin/categories/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-admin-categories--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-admin-categories--id-"
                    onclick="tryItOut('GETapi-admin-categories--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-admin-categories--id-"
                    onclick="cancelTryOut('GETapi-admin-categories--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-admin-categories--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/admin/categories/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-admin-categories--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-admin-categories--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-admin-categories--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the category. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="general-PUTapi-admin-categories--id-">Update a category (Admin only)</h2>

<p>
</p>



<span id="example-requests-PUTapi-admin-categories--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost:8000/api/admin/categories/1" \
    --header "Accept: application/json" \
    --header "Content-Type: application/json" \
    --data "{
    \"title\": \"b\",
    \"description\": \"Eius et animi quos velit et.\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/admin/categories/1"
);

const headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
};

let body = {
    "title": "b",
    "description": "Eius et animi quos velit et."
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-admin-categories--id-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://localhost:3000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-admin-categories--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-admin-categories--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-admin-categories--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-admin-categories--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-admin-categories--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-admin-categories--id-" data-method="PUT"
      data-path="api/admin/categories/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-admin-categories--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-admin-categories--id-"
                    onclick="tryItOut('PUTapi-admin-categories--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-admin-categories--id-"
                    onclick="cancelTryOut('PUTapi-admin-categories--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-admin-categories--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/admin/categories/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/admin/categories/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-admin-categories--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-admin-categories--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-admin-categories--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the category. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="title"                data-endpoint="PUTapi-admin-categories--id-"
               value="b"
               data-component="body">
    <br>
<p>Must not be greater than 150 characters. Example: <code>b</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="PUTapi-admin-categories--id-"
               value="Eius et animi quos velit et."
               data-component="body">
    <br>
<p>Example: <code>Eius et animi quos velit et.</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>parent_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="parent_id"                data-endpoint="PUTapi-admin-categories--id-"
               value=""
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the categories table.</p>
        </div>
        </form>

                    <h2 id="general-DELETEapi-admin-categories--id-">Delete a category (Admin only)</h2>

<p>
</p>



<span id="example-requests-DELETEapi-admin-categories--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost:8000/api/admin/categories/1" \
    --header "Accept: application/json" \
    --header "Content-Type: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/admin/categories/1"
);

const headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-admin-categories--id-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://localhost:3000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-DELETEapi-admin-categories--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-admin-categories--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-admin-categories--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-admin-categories--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-admin-categories--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-admin-categories--id-" data-method="DELETE"
      data-path="api/admin/categories/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-admin-categories--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-admin-categories--id-"
                    onclick="tryItOut('DELETEapi-admin-categories--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-admin-categories--id-"
                    onclick="cancelTryOut('DELETEapi-admin-categories--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-admin-categories--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/admin/categories/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-admin-categories--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-admin-categories--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-admin-categories--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the category. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="general-PATCHapi-admin-users--user_id--trust-score">PATCH api/admin/users/{user_id}/trust-score</h2>

<p>
</p>



<span id="example-requests-PATCHapi-admin-users--user_id--trust-score">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PATCH \
    "http://localhost:8000/api/admin/users/1/trust-score" \
    --header "Accept: application/json" \
    --header "Content-Type: application/json" \
    --data "{
    \"trust_score\": 6
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/admin/users/1/trust-score"
);

const headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
};

let body = {
    "trust_score": 6
};

fetch(url, {
    method: "PATCH",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PATCHapi-admin-users--user_id--trust-score">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://localhost:3000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-PATCHapi-admin-users--user_id--trust-score" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PATCHapi-admin-users--user_id--trust-score"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PATCHapi-admin-users--user_id--trust-score"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PATCHapi-admin-users--user_id--trust-score" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PATCHapi-admin-users--user_id--trust-score">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PATCHapi-admin-users--user_id--trust-score" data-method="PATCH"
      data-path="api/admin/users/{user_id}/trust-score"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PATCHapi-admin-users--user_id--trust-score', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PATCHapi-admin-users--user_id--trust-score"
                    onclick="tryItOut('PATCHapi-admin-users--user_id--trust-score');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PATCHapi-admin-users--user_id--trust-score"
                    onclick="cancelTryOut('PATCHapi-admin-users--user_id--trust-score');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PATCHapi-admin-users--user_id--trust-score"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/admin/users/{user_id}/trust-score</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PATCHapi-admin-users--user_id--trust-score"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PATCHapi-admin-users--user_id--trust-score"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>user_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="user_id"                data-endpoint="PATCHapi-admin-users--user_id--trust-score"
               value="1"
               data-component="url">
    <br>
<p>The ID of the user. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>trust_score</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="trust_score"                data-endpoint="PATCHapi-admin-users--user_id--trust-score"
               value="6"
               data-component="body">
    <br>
<p>Must be at least 0. Must not be greater than 10. Example: <code>6</code></p>
        </div>
        </form>

            

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                                        <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                                        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                            </div>
            </div>
</div>
</body>
</html>
