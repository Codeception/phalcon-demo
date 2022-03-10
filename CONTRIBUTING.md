# Contributing to the Phalcon Demo Application

The Phalcon Demo Application is an open source project based on volunteer efforts. We welcome contributions from anyone.

## Contributions

Contributions to Phalcon Demo Application should be made using [GitHub pull requests][pr]. Each pull request will be
reviewed by a core contributor (someone with permission to merge patches) and it will either merged in the `master`
branch or feedback for changes will be provided to ensure maximum quality and functionality for the project.
Core contributors are not exempt.

## Questions & Support

*We only accept bug reports, new feature requests and pull requests in GitHub*.

For questions on how to use the Phalcon Demo Application or support requests please visit the
[official Phalcon forums][forum] or the [PHP Test Club][forum-qa].

## Bug Report Checklist

- Make sure you are using the latest release of the Phalcon Demo Application before submitting a bug report.
  Bugs in versions older than the latest release will not be addressed by the core team.

- If you have found a bug it is important to add information on how to reproduce it. This will allow us to fix the issue
  quicker. Adding a script, a failing test, providing as much information as possible is essential to identify the issue
  and fix it in a timely manner. [Submit Reproducible Test][srt] for more information.

- Please ensure that you provide additional information regarding the development environment with your bug, such as OS,
  Phalcon Framework, Codeception, Phalcon Demo Application versions as well as the PHP version

- If you're submitting a Segmentation Fault error, we would require a backtrace, please see [Generating a Backtrace][gb]

## Pull Request Checklist

- Don't submit your pull requests to the `master` branch. Those will be rejected immediately. Branch from the required
  version branch and, if needed, rebase to the proper branch before submitting your pull request. If your pull request
  cannot be merged with cleanly, you may be asked to rebase your changes

- Don't put submodule updates, `composer.lock`, etc in your pull request unless they are to merged commits

- Make sure that the code you write adheres to the coding standards of the [Accepted PHP Standards][psr]

## Getting Support

If you have a question about how to use Phalcon Framework, please see the [Phalcon's support page][support].
For Codeception related questions please refer to the [Codeception Documentation][codecept-doc].

## Requesting Features

If you have a change or new feature in mind, please fill an [NFR][nfr].

Thanks! <br />
Phalcon Team

[pr]: https://help.github.com/articles/using-pull-requests
[forum]: https://forum.phalconphp.com
[forum-qa]: https://phptest.club/
[srt]: https://github.com/phalcon/cphalcon/wiki/Submit-Reproducible-Test
[gb]: https://github.com/phalcon/cphalcon/wiki/Generating-a-backtrace
[support]: https://phalconphp.com/support
[codecept-doc]: https://codeception.com/docs/
[nfr]: https://github.com/phalcon/cphalcon/wiki/New-Feature-Request---NFR
[psr]: https://www.php-fig.org/psr/
