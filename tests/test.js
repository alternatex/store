// TEST
/*
1. create instance default cfg
2. update cfg in proto - check in instance
3. again
4. upd instance cfg
5. check
6. upd proto
7. check instance
*/

var aobj = new Store();

function assertEqual(msg, source, target){
  if(source===target){
    console.info(msg, source, target);
    return true;
  } else {
    console.warn(msg, source, target);
    return false;
  }
}