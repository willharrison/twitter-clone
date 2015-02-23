<?php namespace Twitter\Handlers\Commands;

use Twitter\Commands\UpdateProfileImage;

use Twitter\Factories\ImageFactory;
use Twitter\Repositories\ImageRepository;

class UpdateProfileImageHandler {

    protected $factory, $repo;

	public function __construct(
        ImageFactory $factory,
        ImageRepository $repo)
	{
        $this->factory = $factory;
        $this->repo = $repo;
	}

    /**
     * Handle the command.
     *
     * @param  UpdateProfileImage  $command
     * @return void
     */
    public function handle(UpdateProfileImage $command)
    {
        $imageId = $this->factory->create($command->user->id, $command->image);
        $oldId = $command->user->profile->image_id;

        $command->user->profile->image_id = $imageId;
        $command->user->profile->save();

        if ($oldId != null)
        {
            $this->repo->remove($oldId);
        }
    }

}
