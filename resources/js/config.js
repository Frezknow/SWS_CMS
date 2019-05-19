export const getHeader = function(){
  const tokenData = JSON.parse(window.localStorage.getItem('authUser'));
  const headers = {
    'Accepted'=>'application/json',
    'Authorization' : 'Bearer '=> tokenData.access_token
  }
  return headers;
}
