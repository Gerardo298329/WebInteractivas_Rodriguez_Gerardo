<?php
// Datos fijos por ahora. Después se reemplazan por modelos/BD.
return [
 "whatsapp"=>"524441234567","phone"=>"+524441234567","envio"=>30,"minimo"=>150,
 "sizes"=>["Chica"=>-20,"Mediana"=>0,"Grande"=>30],
 "masas"=>["Tradicional"=>0,"Delgada"=>0,"Orilla de queso"=>25],
 "quesos"=>["Mozzarella"=>0,"Mozzarella doble"=>20,"Mixto"=>15],
 "ingredients"=>["Aceitunas"=>12,"Cebolla"=>10,"Champiñón"=>15,"Chorizo"=>15,"Jalapeño"=>10,"Jamón"=>15,"Pepperoni"=>15,"Pimiento"=>10,"Piña"=>15,"Tocino"=>15],
 "pizzas"=>[
  "hawaiana"=>["name"=>"Hawaiana","price"=>149,"desc"=>"Jamón, piña","tags"=>[],"ings"=>["Jamón","Piña"]],
  "pepperoni"=>["name"=>"Pepperoni","price"=>139,"desc"=>"Pepperoni","tags"=>["Sin gluten"],"ings"=>["Pepperoni"]],
  "mexicana"=>["name"=>"Mexicana","price"=>159,"desc"=>"Champiñón, jalapeño, chorizo","tags"=>["Picante"],"ings"=>["Champiñón","Jalapeño","Chorizo"]],
  "duo"=>["name"=>"Dúo","price"=>169,"desc"=>"Pepperoni, jamón","tags"=>[],"ings"=>["Pepperoni","Jamón"]],
  "arma"=>["name"=>"Arma la tuya","price"=>119,"desc"=>"Sin ingredientes por defecto","tags"=>["Vegetariana"],"ings"=>[]],
 ],
 "items"=>[
  "Bebidas"=>[["Refresco 600 ml",30,"Cola, naranja o limón"],["Agua de horchata 1 L",45,"Hecha en casa"],["Refresco 2 L",55,"Para compartir"]],
  "Postres"=>[["Brownie",40,"Con nuez"],["Canela dulce",35,"Masa de pizza y canela"],["Flan",38,"Receta de la casa"]],
  "Extras"=>[["Aderezo ranch",12,"Porción"],["Pan de ajo",49,"6 piezas"],["Orilla extra de queso",25,"Por pizza"]],
 ],
 "promos"=>[
  ["2x1 los martes","En pizzas medianas de la carta.","Todos los martes","warning"],
  ["Combo familiar","2 pizzas grandes y una bebida de 2 L.","Hasta fin de mes","danger"],
  ["Paquete para fiestas","6 pizzas, bebidas y postre.","Con 48 h de anticipación","info"],
 ],
 "reviews"=>[["Mariana López",5,"La Mexicana llegó caliente en 25 minutos. Ya es mi pizzería de los viernes."],["Carlos Ramírez",5,"Armé la mía con orilla de queso y tocino. Pedir desde el celular es muy fácil."],["Fernanda Soto",4,"El combo familiar rinde mucho y el servicio es muy amable."]],
 "locations"=>[["Pizzería Ya Plaza del Carmen","Calle Ejemplo 101, Centro Histórico"],["Pizzería Ya Plaza de Armas","Calle Ejemplo 202, Centro Histórico"],["Pizzería Ya Alameda","Calle Ejemplo 303, Centro Histórico"]],
 "hours"=>[["Lunes a jueves","1:00 – 10:00 pm"],["Viernes y sábado","1:00 pm – 12:00 am"],["Domingo","1:00 – 9:00 pm"]],
];
