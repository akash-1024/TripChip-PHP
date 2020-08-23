
function messageReceived(message) {
  console.log("Push Message payload = "+ message.payload + " Subchannel Id="+message.subchannelId);

  var notification = window.webkitNotifications.createNotification(
      'icon.jpg', 'Push Message',
       message.payload +" [" + message.subchannelId + "]");
      
 	 notification.show();
  
}
function ListenForMessages() 
{
  console.log("Listening for messages");
  // Begin listening for Push Messages.
  chrome.pushMessaging.onMessage.addListener(messageReceived);

}

function channelIdCallback(message) {
  	console.log("Background Channel ID callback seen, channel Id is " + message.channelId);

	  ListenForMessages();

	 chrome.app.window.create("PushHome.html?channelId="+message.channelId);

}


// This function gets called in the packaged app model on launch.
chrome.app.runtime.onLaunched.addListener(function(launchData) {
	
  	chrome.pushMessaging.getChannelId(true, channelIdCallback);
});

//This is called when the extension is installed.
chrome.runtime.onInstalled.addListener(function() 
{
	console.log("Push Messaging Sample Client installed!");

	chrome.pushMessaging.getChannelId(true, channelIdCallback);
});
