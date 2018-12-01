(function () {
    'use strict';

    /**
     * Orchestrates the status fetching and outputs the response in the dashboard widget.
     */
    function CircleCIStatus() {

        let self = this;

        this.statusContainer = document.getElementsByClassName('wp-circleci-status');
        this.incidentsHTML = '';
        this.statusSource = new StatusPage.page({page: '6w4r0ttlx5ft'});
        this.maxItems = 10;

        /**
         * Removes the 'Loading the incidents ...' label.
         */
        this.emptyHTML = function () {

            this.statusContainer[0].innerHTML = '';

        }

        /**
         * Retrieves the incidents from the Status Page API.
         */
        this.getIncidents = function () {

            this.statusSource.incidents({

                success: function (response) {

                    self.buildHTML(response.incidents);

                }

            });

        }


        /**
         * Builds the HTML list items.
         *
         * It will display, by default, the following options: name, status, impact and URL to details.
         *
         * For more options, please visit: https://status.circleci.com/api#incidents
         *
         * @param data
         */
        this.buildHTML = function (data) {

            Object.keys(data.slice(0, this.maxItems)).map(function (index) {

                let item = data[index];

                self.incidentsHTML += '<li>';
                self.incidentsHTML += '<a href="' + item.shortlink + '" target="_blank">';
                self.incidentsHTML += '<span class="status ' + item.status + '">';
                self.incidentsHTML += item.status;
                self.incidentsHTML += '</span>';
                self.incidentsHTML += item.name;
                self.incidentsHTML += ' (' + item.impact + ')';
                self.incidentsHTML += '</a>';
                self.incidentsHTML += '</li>';

            });

            this.updateHTML();
        }

        /**
         * Appends the newly generated contents to the dashboard widget.
         */
        this.updateHTML = function () {

            this.statusContainer[0].innerHTML = '<ul>' + self.incidentsHTML + '</ul>';
        }

        /**
         * Runs all the methods required for displaying the incidents.
         */

        this.display = function () {

            this.emptyHTML();

            this.getIncidents();

        }
    }

    /**
     * Instantiates the CircleCIStataus class.
     *
     * @type {CircleCIStatus}
     */
    let circleCI = new CircleCIStatus();
    circleCI.display();

})();
