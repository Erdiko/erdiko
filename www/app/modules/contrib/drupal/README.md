README
======
To leverage Drupal using Erdiko add your Drupal code at the same level as Erdiko.  For instance look at the heirarchy below


/your-repo/
	/drupal (Drupal root)
	/www (Erdiko root)

In your custom module where you want to use Drupal, simply inherit from the \app\modules\contrib\drupal\Model class.

