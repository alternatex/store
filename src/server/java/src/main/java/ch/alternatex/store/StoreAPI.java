// -------------------------------------------------------------
// ------------------------ STORE API --------------------------
// -------------------------------------------------------------

/**
 *
 * Compile:
 * --------
 * javac -cp .:retrofit-1.2.2.jar:spring-context-3.0.2.RELEASE.jar:spring-web-3.2.4.RELEASE.jar:slf4j-api-1.7.5.jar TestStoreAPI.java
 *
 * Run:
 * ----
 * java -cp .:retrofit-1.2.2.jar:gson-2.2.4.jar:spring-web-3.2.4.RELEASE.jar:spring-context-3.0.2.RELEASE.jar:slf4j-api-1.7.5.jar:logback-classic-1.0.13.jar:logback-core-1.0.13.jar TestStoreAPI
 *
 * Resources:
 * ----------
 * DeferredResult - asynchronous processing in Spring MVC - http://nurkiewicz.blogspot.ch/2013/03/deferredresult-asynchronous-processing.html
 *
 */

// -------------------------------------------------------------
// ----------------------- DEPENDENCIES ------------------------
// -------------------------------------------------------------

import retrofit.Callback;
import retrofit.RetrofitError;
import retrofit.RestAdapter;

import retrofit.app.Request;
import retrofit.app.Response;

import retrofit.http.DELETE;
import retrofit.http.GET;
import retrofit.http.HEAD;
import retrofit.http.POST;
import retrofit.http.PUT;

import retrofit.http.Path;
import retrofit.http.Query;

import org.slf4j.Logger;
import org.slf4j.LoggerFactory;

// -------------------------------------------------------------
// --------------------------- API -----------------------------
// -------------------------------------------------------------

public class StoreAPI {

  // ----------------------------------------------------------
  // ----------------------- HELPERS --------------------------
  // ----------------------------------------------------------
  
  // logging *
  private static final Logger LOG = LoggerFactory.getLogger(TestStoreAPI.class);

  // ----------------------------------------------------------
  // -------------------- CONFIGURATION -----------------------
  // ----------------------------------------------------------

  // about
  static final String API_VERSION = "0.1.0";

  // settings
  static final String API_ENDPOINT = "http://localhost";

  // settings - xxx
  static final String API_APP = "/{app}/";    
  static final String API_STORE = "/{app}/stores/{store}/";  
  static final String API_DEVICE = "/{app}/stores/{store}/devices/{device}/";  
  static final String API_USER = "/{app}/stores/{store}/users/{username}/";  

  // ----------------------------------------------------------
  // ----------------------- RESOURCES ------------------------
  // ----------------------------------------------------------

  // app resources 
  interface App {
    @HEAD(API_APP)
    AppData get(
      @Path("app") String app
    );
  }

  // store resources
  interface Store {
    @HEAD(API_STORE)
    StoreData get(
      @Path("app") String app, 
      @Path("store")  String store
    );
  }

  // device resources
  interface Device {
    @POST(API_DEVICE)
    Token authorize(
      @Path("app") String app, 
      @Path("store") String store, 
      @Path("device") String device, 
      @Query("username") String username, 
      @Query("password") String password
    );
    @DELETE(API_DEVICE)
    Token revoke(
      @Path("app") String app, 
      @Path("store") String store, 
      @Path("device") String device, 
      @Query("username") String username, 
      @Query("password") String password
    );
  }

  // user resources
  interface User {
    @HEAD(API_USER)
    UserData user(
      @Path("username") String username
    );
  }

  // ----------------------------------------------------------
  // ----------------------- DATA OBJECTS ---------------------
  // ----------------------------------------------------------

  // system: app 
  static class AppData {
    String app;
  }

  // system: store
  static class StoreData {
    String store;
  }

  // system: device
  static class DeviceData {
    String device;
    String requestToken;
  }

  // system: user
  static class UserData {
    String username;
    String pass;
  }

  // security: token
  static class Token {
    String token;
  }

  // ----------------------------------------------------------
  // ------------------------- MAIN ---------------------------
  // ----------------------------------------------------------

  /**
  * 
  * @param args
  */
  public static void main(String... args) {

    // ...
    RestAdapter restAdapter = new RestAdapter.Builder()
    .setServer(API_ENDPOINT)
    .build();

    // ...
    Callback callback = new Callback() {
        @Override
        public void success(Object o, Response response) {
          // ...
        }

        @Override
        public void failure(RetrofitError retrofitError) {
          // ...
        }
    };

    // ...  
    String appname = "app";
    String storename = "store";
    
    // ...  
    String username = "username";
    String password = "password";

    // ...  
    String deviceid = "c6c5f850-1e40-11e3-8224-0800200c9a66";

    LOG.info("Requesting app - `"+appname+"`");

    // retrieve app     
    App app = restAdapter.create(App.class);
    AppData appTest = app.get(appname);
    
    // debug
    LOG.info("Requesting store - `"+storename+"`");
    
    // retrieve store    
    Store store = restAdapter.create(Store.class);
    StoreData storeTest = store.get(appname, storename);

    // debug
    LOG.info("Requesting device - `"+deviceid+"`");
    
    // retrieve device    
    Device device = restAdapter.create(Device.class);

    // debug
    LOG.info("Revoking device - `"+deviceid+"`");        
    
    // revoke device    
    Token deviceData = device.revoke(appname, storename, deviceid, username, password);

    // debug
    LOG.info("Authorizing device - `"+deviceid+"`");    

    // authorize device
    Token token = device.authorize(appname, storename, deviceid, username, password);

    // shout out loud
    System.out.println("token: " + token.token);
  }
}