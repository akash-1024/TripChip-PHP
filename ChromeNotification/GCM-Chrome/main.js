function channelIdCallback(message) 
{
    document.getElementById("channel").value= message.channelId;
}

document.addEventListener('DOMContentLoaded', function() {
  
  	chrome.pushMessaging.getChannelId(true, channelIdCallback);

  
});