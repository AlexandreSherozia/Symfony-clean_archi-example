# Symfony-clean_archi-example
#HTML and API REST UseCase examples
symfony composer install

yarn install

#for Webpack Encore, Tailwind...
yarn run build

#Test of creation of Garage with Postman :

#POST
#https://127.0.0.1:8000/api/garage

Check the "raw" radio of the Body Tab, 
select JSON in the text format options, then add the following payload :

{
  "name": "My Garage with clean archi test",
  "address": "rue de test",
  "siren": "12345678901234"
}

