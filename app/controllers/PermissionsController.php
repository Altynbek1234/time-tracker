<?php



namespace Time\Controllers;

use Time\Models\Profiles;
use Time\Models\Permissions;

class PermissionsController extends ControllerBase
{
    /**
     * View the permissions for a profile level, and change them if we have a POST.
     */
    public function indexAction()
    {
        $this->view->setTemplateBefore('private');

        if ($this->request->isPost()) {
            // Validate the profile
            $profile = Profiles::findFirstById($this->request->getPost('profileId'));
            if ($profile) {
                if ($this->request->hasPost('permissions') && $this->request->hasPost('submit')) {
                    // Deletes the current permissions
                    $profile->getPermissions()->delete();
                    // Save the new permissions
                    foreach ($this->request->getPost('permissions') as $permission) {
                        $parts = explode('.', $permission);

                        $permission = new Permissions();
                        $permission->profilesId = $profile->id;
                        $permission->resource = $parts[0];
                        $permission->action = $parts[1];

                        $permission->save();
                    }

                    $this->flash->success('Permissions were updated with success');
                }


//                print_die($this->acl->rebuild());// Rebuild the ACL with
                $this->acl->rebuild();


                // Pass the current permissions to the view
                $this->view->permissions = $this->acl->getPermissions($profile);
            }

            $this->view->profile = $profile;
        }

        // Pass all the active profiles
        $this->view->profiles = Profiles::find([
            'active = :active:',
            'bind' => [
                'active' => 'Y'
            ]
        ]);
    }
}
