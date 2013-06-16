Store
=============

A lightweight datastore wrapper providing CRUD operations for arbitrary objects. 

Index
-------------
* [Quickstart](#quickstart)
  * [Embedding](#embedding)
  * [Defaults](#defaults)
  * [Store](#create-store)
      * [Create](#create-store)
  * [Object](#create-object)
      * [Create](#create-object)
      * [Get](#get-object)
      * [Store](#store-object)
      * [Remove](#remove-object)
  * [Summary](#summary)
* [Repositories](#repositories)
* [Wishlist](#wishlist)
* [Documentation](#documentation)
* [Roadmap](#roadmap)
* [License](#license)

Quickstart
-------------

### Embedding

#### Require.js
```javascript
require(["store"], function(Store) {
  // ...
});
```

#### HTML
```html
<script src="src/client/store.js"></script>
```

### Defaults

Defaults are modified as follows:

```javascript
Store.configure({ 
  url: "http://localhost/datastore.php", 
  ttl: 36000
});
```
**Note**

`configure()` alters the prototype object, hence modifications are propagated to instances on property level given that the respective instance properties have not been modified previously.

### Create Store
```javascript
var objectStore = new Store({ namespace: 'object' });
```

### Create Object

#### Preset 
```javascript
var object = objectStore.create({ 
  country: 'USA', 
  firstname: 'Stephen', 
  lastname: 'Colbert' 
}); 
```

#### Barebone
```javascript
var object = objectStore.create(); 
object.set('country', 'USA');
object.set('firstname', 'John'); 
object.set('lastname', 'Stewart'); 
```

### Get Object

#### List
```javascript
objectStore.list();
```

#### Single
```javascript
objectStore.get('8c0c1ff0-d0fe-38b7-376a-b0b1d53bd557');
```

### Store Object

#### Instance
```javascript
object.update();
```

#### Datastore
```javascript
objectStore.update(object);
```

#### Datastore w/ arbitrary object
```javascript
objectStore.update({ name: 'XXXXX', type: 'XXXXX', rank: 'XXXXX' });
```

### Remove Object

#### Instance
```javascript
object.remove();
```

#### Datastore
```javascript
objectStore.remove(object);
```

### Summary
```html
<script src="src/client/store.js"></script>
<script>
(function(){

  // local variables
  var object, objectId, objectStore, objects;

  // configure storage defaults 
  Store.configure({ 
    url: "http://localhost/store/docs/examples/server.php", 
    ttl: 36000
  });

  // create new storage
  objectStore = new Store({ namespace: 'object' });

  // create new storage bound object
  object = objectStore.create({ 
    country: 'US', 
    firstname: 'Stephen', 
    lastname: 'Colbert' 
  });
  
  // insert object
  object = object.update();

  // update on insert
  Store.when(object).done(function(object){
    
    // wrap json object
    object = objectStore.create(object);

    // update properties
    object.set('firstname', 'John');
    object.set('lastname', 'Stewart');

    // extract
    objectId = object.get('id');

    // update object
    object.update().done(function(object){        

        // fetch object w/previously retrieved objectId
        objectStore.get(objectId).done(function(object){

           // wrap json object
           object = objectStore.create(object);

           // say hi
           console.log(object.get('firstname') + " " + object.get('lastname'));
        });
    });
  });

  // collect update promises
  objects = [];

  // create some objects
  Store.times(10, function(count){

    // store update promises
    objects.push(objectStore.create({ 
      title: 'No.' + count,       
      abstract: 'Lorem Ipsum [...]',       
      text: 'Lorem Ipsum Si Amet They Say',             
      author: 'me', 
      lastmod: new Date().getTime()
    }).update());
  });

  // upon promises fulfillment
  Store.when(objects)
    .done(function(objects){
      console.log("done", objects);
    })
    .fail(function(objects){
      console.log("fail", objects);
    })
    .always(function(objects){
      console.log("always", objects);
    });  

  // fetch all objects & register callback 
  objects = objectStore.list();

  // when all objects have been retrieved
  Store.when(objects).done(function(objects){

    // log each
    objects.forEach(function(object, index){
      console.log(index, object);
    });
  });

  // fetch object 
  object = objectStore.get(objectId);

  // process fetched object
  Store.when(object).done(function(object){
    console.log("object", object);
  });
})();
</script>
```

Repositories
-------------

### PHP Object Store

Stores data using PHPs `serialize()` function. Supports embedding binary data base64 encoded.

**Limitations** 

Built with prototyping in mind. Won't scale.

Documentation
-------------
- [API Docs](https://github.com/alternatex/store/blob/stable/docs/api/index.html)
- [Usage](https://github.com/alternatex/store/blob/stable/docs/index.md)

Roadmap
-------------
- Ajax Requests
  - Proxy (CS)
  - POST 
    - *
    - Files
- Security (CSRF & friends)
- Test Coverage + 1
- Documentation / Examples
  - Stores
  - Todo-App

Wishlist
-------------
- JSON Schema
- REST Client
  - Node.js
  - PHP
- Repositories 
  - MongoDB
  - Redis
  - HTML5
  - PHPCR
- Synchronization
- HTML5 FileSystem API
- Filters Client/Server

License
-------------
Released under two licenses: new BSD, and MIT. You may pick the
license that best suits your development needs.

https://raw.github.com/alternatex/store/master/LICENSE