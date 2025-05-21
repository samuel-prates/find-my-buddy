# Helm Chart for FindMyBuddy

This Helm chart deploys the FindMyBuddy application on a Kubernetes cluster using Minikube.

## Prerequisites

- Kubernetes cluster (Minikube)
- Helm installed

## Installation

To install the chart, use the following command:

```bash
helm install my-findmybuddy ./helm-chart
```

Replace `my-findmybuddy` with your desired release name.

## Configuration

You can customize the deployment by modifying the `values.yaml` file. This file contains default configuration values that can be overridden.

## Resources

The chart includes the following Kubernetes resources:

- **Deployment**: Manages the deployment of the application.
- **Service**: Exposes the application to the network.
- **Ingress**: Routes external traffic to the application.
- **ConfigMap**: Stores non-confidential data.
- **Secret**: Stores sensitive data securely.

## Uninstallation

To uninstall the chart, use the following command:

```bash
helm uninstall my-findmybuddy
```

Replace `my-findmybuddy` with the release name you used during installation.