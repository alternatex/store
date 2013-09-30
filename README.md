Store
=============

A lightweight datastore wrapper providing CRUD operations for arbitrary objects. 

Index
-------------
* [Quickstart](#quickstart)
  * [Embedding](#embedding)
  * [Defaults](#defaults)
  * [Store](#store-1)
      * [Create](#create)
  * [Object](#object)
      * [Create](#create-1)
      * [Get](#get)
      * [Store](#store-2)
      * [Remove](#remove)
  * [Access Control](#access-control)
      * [Auth](#auth)
      * [User](#user)
  * [Summary](#summary)
* [Repositories](#repositories)
* [Wishlist](#wishlist)
* [Documentation](#documentation)
  * [CURL](#curl)
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

### Store

#### Defaults

Defaults are modified as follows:

```javascript
Store.configure({ 
  url: "http://localhost/datastore.php", 
  ttl: 36000
});
```
**Note**

`configure()` alters the prototype object, hence modifications are propagated to instances on property level given that the respective instance properties have not been modified previously.

#### Create 

```javascript
var objectStore = new Store({ namespace: 'object' });
```

### Object

#### Create 

##### Preset 
```javascript
var object = objectStore.create({ 
  country: 'USA', 
  firstname: 'Stephen', 
  lastname: 'Colbert' 
}); 
```

##### Barebone
```javascript
var object = objectStore.create(); 
object.set('country', 'USA');
object.set('firstname', 'Jon'); 
object.set('lastname', 'Stewart'); 
```

#### Get

##### List
```javascript
objectStore.list();
```

##### Single
```javascript
objectStore.get('8c0c1ff0-d0fe-38b7-376a-b0b1d53bd557');
```

#### Store

##### Instance
```javascript
object.update();
```

##### Datastore
```javascript
objectStore.update(object);
```

#### Remove

##### Instance
```javascript
object.remove();
```

##### Datastore
```javascript
objectStore.remove(object);
```

### Access Control
...

#### Auth 
...

#### User
...

### Summary

```html
<script src="src/client/store.js"></script>
<script>
(function(){

  // local variables
  var object, objectId, objectStore, objects;

  // configure store defaults 
  Store.configure({ 
    url: "http://localhost/store/examples/server.php", 
    ttl: 36000
  });

  // create new store
  objectStore = new Store({ namespace: 'object' });

  // create new store bound object
  object = objectStore.create({ 
    country: 'US', 
    firstname: 'Stephen', 
    lastname: 'Colbert' 
  });
  
  // update on insert 
  object.update().done(function(object){
    
    // wrap json object
    object = objectStore.create(object);

    // update properties
    object.set('firstname', 'Jon');
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

  // when all objects have been updated
  Store.when(objects).done(function(objects){
  
    // fetch all objects 
    objects = objectStore.list();
    
    // print when object have been retrieved
    Store.when(objects).done(function(objects){

      // log each
      objects.forEach(function(object, index){
        console.log(index, object);
      });
    });    
  });

  // fetch object 
  object = objectStore.get(objectId);

  // process fetched object
  Store.when(object).done(function(object){  

    // execute on success  
    console.log("done", object);  

  }).fail(function(objects){    

    // execute on fail
    console.log("fail", objects);    

  }).always(function(objects){    

    // always execute this block
    console.log("always", objects);

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

### CURL
```shell

curl -h ...
```

Roadmap
-------------
- Record/Playback
  - Inspector
- Driver/Format Base Classes/Extraction  
- Ajax Requests
  - Proxy (CS)
  - File Uploads
- Client Queries (Memory/Localstorage)
  - Remote List » Local Get
- Documentation / Examples
  - Stores
  - Settings
  - Todo-App
- Security (CSRF & friends)
- Test Coverage + 1

Wishlist
-------------
- JSON Schema
- REST Client
  - Node.js
  - PHP
- Repositories 
  - Dropbox
  - Git
  - Riak
  - JCR
  - MongoDB
  - Redis
  - PHPCR
  - HTML5 Stores (*)
- Synchronization
- HTML5 FileSystem API
- Filters Client/Server

License
-------------
Released under two licenses: new BSD, and MIT. You may pick the
license that best suits your development needs.

https://raw.github.com/alternatex/store/stable/LICENSE