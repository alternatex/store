Store
=============

[![Build Status](https://secure.travis-ci.org/alternatex/store.png?branch=master)](http://travis-ci.org/alternatex/store) 

A lightweight datastore wrapper providing CRUD operations for arbitrary objects. 

Index
-------------
* [Quickstart](#quickstart)
  * [Embedding](#embedding)
* [Client API](#client-api)
  * [Store](#store-1)
      * [Configure](#configure)
      * [Create](#create)
  * [Object](#object)
      * [Create](#create-1)
      * [Read](#read)
      * [Update](#update)
      * [Delete](#delete)
  * [Summary](#summary)
* [Server API](#server-api)
* [Repositories](#repositories)
      * [File Stores](#file-stores)
          * [CSV](#csv)
          * [JSON](#json)
          * [Serialized](#serialized)
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

Client API
-------------

### Store

#### Configure

Defaults are configured as follows:

```javascript
Store.configure({ 
  url: "http://localhost/datastore.php", 
  ttl: 3600
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

#### Read

##### List
```javascript
objectStore.list();
```

##### Single
```javascript
objectStore.get('8c0c1ff0-d0fe-38b7-376a-b0b1d53bd557');
```

#### Update

##### Instance
```javascript
object.update();
```

##### Datastore
```javascript
objectStore.update(object);
```

#### Delete

##### Instance
```javascript
object.remove();
```

##### Datastore
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

  // configure store defaults 
  Store.configure({ 
    url: "http://localhost/store/examples/server.php", 
    ttl: 3600
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
  objectStore.update(object).done(function(object){
    
    // wrap json object
    object = objectStore.create(object);

    // update properties
    object.set('firstname', 'Jon');
    object.set('lastname', 'Stewart');

    // extract
    objectId = object.get('id');

    // update object
    objectStore.update(object).done(function(object){        

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
    console.info("done", object);  

  }).fail(function(objects){    

    // execute on fail
    console.error("fail", objects);    

  }).always(function(objects){    

    // always execute this block
    console.log("always", objects);

  });

})();
</script>

<!-- example html input -->
<form method="POST" action="//localhost/store/examples/server.php/resources/update" enctype="multipart/form-data">      
  <input type="hidden" name="namespace" value="resources"/>
  <input type="hidden" name="action" value="update"/>
  <input type="hidden" name="instance[type]" value="type"/>
  <input type="hidden" name="instance[name]" value="name"/>
  <input type="hidden" name="instance[option][key]" value="key"/>
  <input type="hidden" name="instance[option][value]" value="value"/>
  <input type="hidden" name="instance[option][lists][whitelist][]" value="good.host.com"/>
  <input type="hidden" name="instance[option][lists][blacklist][]" value="evil.host.com"/>
  <input type="file" name="instance[file]"/>
  <button>Update</button>
</form>
```

### Routes

...

Server API
-------------

[![Latest Stable Version](https://poser.pugx.org/alternatex/store/v/stable.png)](https://packagist.org/packages/alternatex/store)
[![Dependency Status](https://david-dm.org/alternatex/store.png)](https://david-dm.org/alternatex/store)

Repositories
-------------

### File Stores

Collections stored on a file basis.

**Limitations** 

Built with prototyping in mind. Won't scale.

#### CSV

...

#### JSON

Supports embedding binary data base64 encoded.

#### Serialized

Stores data using PHPs `serialize()` function. Supports embedding binary data base64 encoded.

Documentation
-------------
- [API](http://alternatex.github.io/store/docs/)
- [Examples](http://alternatex.github.io/store/examples/)

Roadmap
-------------
- Access Control
- Synchronization
- JSON Schema
  - Generators

License
-------------
Released under two licenses: new BSD, and MIT. You may pick the
license that best suits your development needs.

https://raw.github.com/alternatex/store/master/LICENSE
