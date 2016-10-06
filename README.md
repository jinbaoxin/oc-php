## PHP on Openshift

#### Piepiline example

```yml
apiVersion: v1
kind: BuildConfig
metadata:
  name: sample-pipeline
  namespace: myproject
  labels:
    app: jenkins-pipeline-example
    name: sample-pipeline
    template: application-template-sample-pipeline
  annotations:
    pipeline.alpha.openshift.io/uses: '[{"name": "myphp", "namespace": "", "kind": "DeploymentConfig"}]'
spec:
  runPolicy: Serial
  source:
    type: None
  strategy:
    type: JenkinsPipeline
    jenkinsPipelineStrategy:
      jenkinsfile: "node {\nstage 'build'\nopenshiftBuild(buildConfig: 'myphp', showBuildLogs: 'true')\nstage 'deploy'\nopenshiftDeploy(deploymentConfig: 'myphp')\n}"
  output:
  resources:
  postCommit:
  ```
