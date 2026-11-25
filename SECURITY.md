# Security Policy

## Reporting a vulnerability

**Do not report a vulnerability in a public issue, pull request or discussion.** Write to
[security@ph-il.ca](mailto:security@ph-il.ca) instead, with:

- a description of the vulnerability and of what an attacker can do with it;
- the version or commit of the template affected;
- the steps to reproduce it, or a proof of concept, if you have one;
- anything else that helps: logs, the configuration involved, a suggested fix.

You will get an acknowledgement within 48 hours, and news of the fix as it progresses. Please keep the
vulnerability private until a fixed version is published; we will agree with you on the date of the disclosure and
credit you in the advisory, unless you prefer not to be named.

A vulnerability that also exists in [strangebuzz/MicroSymfony](https://github.com/strangebuzz/MicroSymfony), the
template this one follows, is reported to its maintainers as well.

## How a vulnerability is fixed

- A fix is aimed for within 7 to 14 days of the acknowledgement, sooner for a severe vulnerability.
- The fix is released as a new version of the template, and announced in its release notes and in a GitHub security
  advisory on its repository.
- A commit that fixes a vulnerability is prefixed with `security:`, so that an application created from the template
  can find it and apply it.

## Supported versions

Only the latest version, on the main branch, receives security fixes. An application created from the template is
its own code from then on: apply the `security:` commits that concern it.

## Dependencies

A vulnerability in a dependency is fixed by raising the dependency's constraint once a fixed release exists.
`composer audit`, which `castor lint:composer` runs, reports the known advisories, and Composer refuses to install a
version with one.
