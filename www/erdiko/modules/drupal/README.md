Drupal Module
=============
To leverage Drupal using Erdiko add your Drupal code at the same level as Erdiko.  For instance look at the heirarchy below


/your-repo/
	/drupal (Drupal root)
	/www (Erdiko root)

In your custom Model where you want to leverage Drupal, 
simply have your Model inherit from the \erdiko\modules\drupal\Model class.
