<div class="pageoverflow">

  <h3>Importing From LI2 Instances</h3>
  
  <div class="pagewarning">
    <h3>Important Information</h3>
    <p><strong>Read this carefully!</strong></p>
    <p>You need to have a ListItExtended installation updated up to it's latest known version (1.4.1).<br />
    Don't attempt to import ListItExtended instances without upgrading as it may result in incomplete LISE instances.</p>
  </div>

  <div class="red">
    <ul>
      <li>This tab will only be visible if there is a valid ListItExtended installation on the current site.</li>
      <li><strong>Make sure you create a full backup or your site and database before taking any further actions.</strong></li>
    </ul>
  </div>
  
  <h4>Step One</h4>
    
  <p>If there are valid ListItExtended instances on the system LISE will be able to detect them and there will appear a button on LISE master module, under the Maintenance tab inside Import Instances From LI2 form. This import button should make a copy of all currently installed LI2 instances, without changing the original ones. However, at this point LISE will not copy the users permissions from LI2, given the lack of a CMSMS Core API to do so. That should be done manually.</p>
  
  <p>Templates may have to be adjusted to work with LISE.</p>
  
  <h4>Step Two</h4>
  
  <p>After you are satisfied with the LISE instance copies you will need to change the calling tags from <strong>{ListIt2&lsaquo;instance_name&rsaquo;}</strong> to <strong>{LISE&lsaquo;instance_name&rsaquo;}</strong> on every template where they are being called.</p>
  
  <h4>Step Three</h4>
  
  <p>Ideally your Field definitions should work again, if that is not the case you should try to repair Field definitions database table by clicking on "Repair" button under "Maintenance" tab.</p>
  <br />
  <p><strong>If you have followed above steps, you should now have a fully functional and upgraded LISE Module and all created Instances.</strong></p>
  <p><strong>After this point you should be able to uninstall LI2 Instances and ListItExtended itself (make sure you keep a full backup just in case).</strong></p>

</div>