# Colors
G=\033[32m
Y=\033[33m
NC=\033[0m

##
## Help
## ----------------------
help: ## List of all commands
	@grep -E '(^[a-zA-Z_0-9-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) \
	| awk 'BEGIN {FS = ":.*?## "}; {printf "${G}%-24s${NC} %s\n", $$1, $$2}' \
	| sed -e 's/\[32m## /[33m/' && printf "\n";

.DEFAULT_GOAL := help
.PHONY: help

##
## Test commands
## ----------------------
test-task-01: ## проверить нарушения очерёдности хода
	./vendor/bin/phpunit --group=rotation

test-task-02: ## проверить нарушения правил хода пешкой (pawn)
	./vendor/bin/phpunit --group=pawn

.PHONY: test-task-01 test-task-02
