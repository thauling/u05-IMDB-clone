follow this:
https://tailwindcss.com/docs/installation

npm install -D tailwindcss
npx tailwindcss init


add this line to HTML 
 <link rel="stylesheet" type="text/css" href="/css/output.css">
 
to start compilation:
npx tailwindcss -i ./resources/css/app.css -o ./public/css/output.css --watch 


