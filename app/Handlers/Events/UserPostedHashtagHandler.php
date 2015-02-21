<?php namespace Twitter\Handlers\Events;

use Twitter\Events\UserPosted;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Twitter\Factories\HashtagFactory;
use Twitter\Factories\HashtagMapFactory;
use Twitter\Repositories\HashtagRepository;
use Twitter\Repositories\PostRepository;
use Twitter\Services\PostParser;

class UserPostedHashtagHandler {

	protected $factory, $map, $repo, $parser;

	public function __construct(
		HashtagFactory $factory,
		HashtagMapFactory $map,
		HashtagRepository $repo,
		PostParser $parser)
	{
		$this->factory = $factory;
		$this->map = $map;
		$this->repo = $repo;
		$this->parser = $parser;
	}

	public function handle($event)
	{
		$hashtags = $this->parser->hashtagsIn($event->postString);

		foreach ($hashtags as $hashtag)
		{
			$this->factory->create($hashtag);

			$hashtagId = $this->repo->findByName($hashtag)->id;
			$this->map->create($hashtagId, $event->postId);
		}
	}

}
